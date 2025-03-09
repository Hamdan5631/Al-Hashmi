<?php

namespace App\Http\Controllers\Api\V1\Carts;

use App\Enums\Carts\CartStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\QuantityChangeRequest;
use App\Http\Requests\Cart\RemoveRequest;
use App\Http\Requests\Cart\StoreRequest;
use App\Http\Resources\Cart\CartCollection;
use App\Models\Cart;
use App\Models\Product;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;


class CartsController extends Controller
{
    public function index(): array
    {
        $carts = Cart::query()
            ->with(['product'])
            ->where('user_id', Auth::id())
            ->where('status', CartStatusEnum::Pending->value)
            ->whereNull('deleted_at')
            ->get();

        return [
          'carts' => new CartCollection($carts),
          'total_price' => $carts->sum('total_price'),
        ];
    }

    /**
     * @throws \Throwable
     */
    public function add(StoreRequest $request): JsonResponse
    {
        $product = Product::query()->findOrFail($request->get('product_id'));

        $cart = Cart::query()
            ->where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->where('status', CartStatusEnum::Pending)
            ->first();

        if ($product->quantity == 0 ||
            $product->quantity < $request->get('quantity')) {

            return $this->jsonResponse(
                message:'We apologize, but this product is temporarily out of stock. Please check back later or contact support for more information.',
                data:null,
                status:422,
            );
        }

        $totalPrice = $product->price * $request->get('quantity');

        DB::beginTransaction();

        try {
//            $this->productQuantityChange($product, $request->get('quantity'));

            if ($cart) {
                $cart->update([
                    'quantity' => $cart->quantity + $request->get('quantity'),
                    'total_price' => $cart->total_price + $totalPrice,
                ]);

                DB::commit();

                return $this->jsonResponse(
                    message: 'Success',
                    data: ['total_products' => Cart::query()->where('user_id', Auth::id())->count()],
                );
            }

            $cart = new Cart();
            $cart->user_id = Auth::id();
            $cart->product_id = $product->id;
            $cart->quantity = $request->get('quantity');
            $cart->total_price = $totalPrice;
            $cart->status = CartStatusEnum::Pending;
            $cart->save();

            DB::commit();

            return $this->jsonResponse(
                message: 'Success',
                data: ['total_products' => Cart::query()
                    ->where('status', CartStatusEnum::Pending)
                    ->where('user_id', Auth::id())
                    ->count()
                ],
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->jsonResponse(
                message: 'Error',
                data: ['error' => $e->getMessage()],
                status: 422
            );
        }

    }

    private function productQuantityChange(Product $product, int $quantity): void
    {
        if ($product->quantity == 0 ||
            $product->quantity < $quantity) {
            abort(response()->json([
                'message' => 'We apologize, but this product is temporarily out of stock. Please check back later or contact support for more information.',
                'data' => null
            ], 422));

        }

        $product->quantity = $product->quantity - $quantity;
        $product->save();
    }

    /**
     * @throws \Throwable
     */
    public function remove(RemoveRequest $request): JsonResponse
    {
        DB::beginTransaction();

        $cart = Cart::query()->findOrFail($request->get('cart_id'));
        $product = Product::query()->findOrFail($cart->product_id);

        $cart->delete();

        DB::commit();

        return $this->jsonResponse(
            message: 'Success',
            data: null,
        );
    }

    /**
     * @throws \Throwable
     */
    public function quantityChange(QuantityChangeRequest $request): JsonResponse
    {
        DB::beginTransaction();

        $cart = Cart::query()->findOrFail($request->get('cart_id'));
        $product = Product::query()->findOrFail($cart->product_id);

        if ($product->quantity == 0 ||
            $product->quantity < $request->get('quantity')) {
            return $this->jsonResponse(
                message: 'We apologize, but this product is temporarily out of stock. Please check back later or contact support for more information',
                data: null,
                 status: 422,
            );
        }

//        $this->productQuantityChange($product, $quantity);

        $cart->quantity = $request->get('quantity');
        $cart->total_price = $product->price * $request->get('quantity');
        $cart->save();

        DB::commit();

        return $this->jsonResponse(
            message: 'Success',
            data: null,
        );
    }
}
