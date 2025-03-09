<?php

namespace App\Http\Controllers\Api\V1\Transmit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transmit\StoreRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductBidding;

class
TransmitController extends Controller
{
    public function __invoke(StoreRequest $request): ProductResource
    {
        $productId = $request->get('product_id');
        $userId = $request->get('user_id');

       ProductBidding::query()
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->update([
                'is_won' => false
            ]);

        ProductBidding::query()
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        $productBidding = ProductBidding::query()->latest()->first();
        $productBidding->is_won = true;
        $productBidding->save();

        return new ProductResource(Product::query()->find($productId));
    }
}
