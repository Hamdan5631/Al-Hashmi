<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Enums\Carts\CartStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ListProductRequest;
use App\Http\Requests\Product\ProductCalculationsRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index(ListProductRequest $request): ProductCollection
    {
        $token = $request->bearerToken();
        $token = PersonalAccessToken::findToken($token);
        $user = optional($token)->tokenable;
        $categoryId = $request->get('category_id');
        $pageLimit = $request->get('limit') ?? 10;
        $isTrending = $request->get('is_trending');
        $isFeatured = $request->get('is_featured');
        $myBids = $request->get('my_bids');
        $myWishlist = $request->get('my_wishlist');
        $isStoreProduct = $request->get('is_store_product');

        $query = Product::query()
            ->with(['productBidding', 'userProductBidding']);

        if (!$myBids) {
            $query->whereActive();
        }

        if (request()->filled('is_store_product')) {
            $query->where('is_store_product', $isStoreProduct);
        }

        $response = QueryBuilder::for($query)
            ->allowedFilters(['name'])
            ->with(['productBidding','userProductBidding','userProductBidding.user'])
            ->allowedSorts(['created_at'])
            ->when($categoryId, function (Builder $query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($isTrending, function (Builder $query) use ($isTrending) {
                $query->where('is_trending', true);
            })
            ->when($isFeatured, function (Builder $query) use ($isFeatured) {
                $query->where('is_featured', true);
            })
            ->when($myBids && $user, function (Builder $query) use ($user) {
                $query->whereHas('userProductBidding', function (Builder $query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })
            ->when($myWishlist, function (Builder $query) use ($user) {
                $query->whereHas('wishlist', function (Builder $query) use ($user) {
                    $query->where('user_id', $user?->id);
                });
            })
            ->when(!$isStoreProduct, function (Builder $query) {
                $query->orderByRaw("STR_TO_DATE(bidding_start_time, '%Y-%m-%d %H:%i:%s') ASC");
            }, function (Builder $query) {
                $query->latest();
            })
            ->jsonPaginate($pageLimit);

        return new ProductCollection($response);
    }

    public function show($id): ProductResource
    {
        return new ProductResource(Product::query()->findOrFail($id));
    }

    public function calculations(ProductCalculationsRequest $request): JsonResponse
    {
        if ($request->get('is_single_product')) {
            $product = Product::query()->findOrFail($request->get('product_id'));
            $shippingCharge = $product->shipping_charge;
            if ($product->is_store_product) {
                $itemPrice = $product->price;

            } else {
                $itemPrice = $product?->productBidding()?->latest()?->first()?->bidding_price;
            }
            $deliveryDay = Carbon::now()->addDays($product->estimated_delivery)->format('Y-m-d');

            $productData[] = new ProductResource($product);

        } else {
            $products = Product::query()
                ->whereIn('id', $request->get('product_ids'))
                ->get();

            $cart = Cart::query()
                ->where('user_id', Auth::id())
                ->whereIn('product_id', $request->get('product_ids'))
                ->where('status', CartStatusEnum::Pending)
                ->get();

            $shippingCharge = $products->sum('shipping_charge');
            $itemPrice = $cart->sum(function ($cartItem) use ($products) {
                $product = $products->firstWhere('id', $cartItem->product_id);
                return $product ? $product->price * $cartItem->quantity : 0;
            });
            $days = $products->max('estimated_delivery');
            $deliveryDay = Carbon::now()->addDays($days)->format('Y-m-d');
            $productData = new ProductCollection($products);
        }

        $total = $itemPrice + $shippingCharge;

        $data = [
            'products' => $productData,
            'shipping_charge' => $shippingCharge,
            'item_price' => $itemPrice,
            'delivery_day' => $deliveryDay,
            'total' => $total,
        ];

        return $this->jsonResponse('success', $data, 200);

    }
}
