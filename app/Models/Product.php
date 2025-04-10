<?php

namespace App\Models;

use App\Enums\Products\ProductStatusEnum;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 *
 *
 * @property int $id
 * @property int $category_id
 * @property int $admin_id
 * @property string $name
 * @property string|null $name_called
 * @property string $description
 * @property int $age_year
 * @property int $age_month
 * @property string $gender
 * @property string $colour
 * @property string $weight
 * @property string $breed
 * @property string $location
 * @property string $bidding_time
 * @property float $price
 * @property float $shipping_charge
 * @property string $estimated_delivery
 * @property int $is_return_product
 * @property int $is_vaccinated
 * @property int $is_trending
 * @property int $is_featured
 * @property string $status ACTIVE,INACTIVE,SOLD
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Category $category
 * @property-read string|null $image_url
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product onlyTrashed()
 * @method static Builder|Product query()
 * @method static Builder|Product whereAdminId($value)
 * @method static Builder|Product whereAgeMonth($value)
 * @method static Builder|Product whereAgeYear($value)
 * @method static Builder|Product whereBiddingTime($value)
 * @method static Builder|Product whereBreed($value)
 * @method static Builder|Product whereCategoryId($value)
 * @method static Builder|Product whereColour($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDeletedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereEstimatedDelivery($value)
 * @method static Builder|Product whereGender($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereIsFeatured($value)
 * @method static Builder|Product whereIsReturnProduct($value)
 * @method static Builder|Product whereIsTrending($value)
 * @method static Builder|Product whereIsVaccinated($value)
 * @method static Builder|Product whereLocation($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereNameCalled($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereShippingCharge($value)
 * @method static Builder|Product whereStatus($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product whereWeight($value)
 * @method static Builder|Product withTrashed()
 * @method static Builder|Product withoutTrashed()
 * @property string $bidding_end_time
 * @method static Builder|Product whereBiddingEndTime($value)
 * @method static Builder|Product whereActive()
 * @property-read int|null $product_bidding_count
 * @property string $brand
 * @property string|null $flavour
 * @property string|null $age_range
 * @property string|null $item_form
 * @property string|null $ingredients
 * @property string|null $specific_use
 * @property int $is_store_product
 * @property-read int|null $wishlist_count
 * @method static Builder|Product whereAgeRange($value)
 * @method static Builder|Product whereBrand($value)
 * @method static Builder|Product whereFlavour($value)
 * @method static Builder|Product whereIngredients($value)
 * @method static Builder|Product whereIsStoreProduct($value)
 * @method static Builder|Product whereItemForm($value)
 * @method static Builder|Product whereSpecificUse($value)
 * @property string|null $quantity
 * @property int $is_veg
 * @method static Builder|Product whereIsVeg($value)
 * @method static Builder|Product whereQuantity($value)
 * @property string|null $return_period
 * @property int|null $on_time_return
 * @method static Builder|Product whereOnTimeReturn($value)
 * @method static Builder|Product whereReturnPeriod($value)
 * @property float|null $actual_price
 * @method static Builder|Product whereActualPrice($value)
 * @property int $is_bidding_started
 * @method static Builder|Product whereIsBiddingStarted($value)
 * @property string|null $bidding_start_time
 * @method static Builder|Product whereBiddingStartTime($value)
 * @property string|null $document_file
 * @property-read string $duration
 * @property-read string|null $image_document_url
 * @method static Builder|Product whereDocumentFile($value)
 * @property-read string|null $document_url
 * @mixin Eloquent
 */
class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $appends = [
        'image_url',
    ];

    public function getProductImage(): string
    {
        return $this->getFirstMediaUrl('product-images');
    }

    public function getProductImages(): \Illuminate\Support\Collection
    {
        return collect($this->getMedia('product-images'))->pluck('original_url');
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

}
