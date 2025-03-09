<?php

namespace App\Http\Controllers\Api\V1\Banner;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __invoke(Request $request): array|\Illuminate\Database\Eloquent\Collection
    {
        $isStoreBanner = $request->get('is_store_banner');

        return Banner::query()
            ->where('is_active', true)
            ->when($isStoreBanner, function ($query) use ($isStoreBanner) {
                $query->where('is_store_banner', $isStoreBanner);
            })
            ->get();
    }

}
