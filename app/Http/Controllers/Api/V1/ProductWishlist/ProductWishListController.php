<?php

namespace App\Http\Controllers\Api\V1\ProductWishlist;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductWishList\ProductRequest;
use App\Models\Wishlist;
use Auth;
use Illuminate\Http\JsonResponse;

class ProductWishListController extends Controller
{
    public function __invoke(ProductRequest $request): JsonResponse
    {
        $productId = $request->get('product_id');
        $addToWishList = $request->get('add_to_wish_list');

        if ($addToWishList == 1 && !Wishlist::query()
                ->where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first()) {
            $wishlist = new Wishlist();
            $wishlist->user_id = Auth::id();
            $wishlist->product_id = $productId;
            $wishlist->save();
        }

        if ($addToWishList == 0) {
            $wishlist = Wishlist::query()
                ->where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            $wishlist->delete();
        }

        return $this->jsonResponse('success', null, 200);
    }
}
