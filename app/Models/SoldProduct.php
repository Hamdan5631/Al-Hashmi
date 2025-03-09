<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int $product_id
 * @property int $admin_id
 * @property int|null $quantity_sold
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SoldProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SoldProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SoldProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|SoldProduct whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoldProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoldProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoldProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoldProduct whereQuantitySold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoldProduct whereUpdatedAt($value)
 * @property-read \App\Models\Admin|null $employee
 * @property-read \App\Models\Product|null $product
 * @mixin \Eloquent
 */
class SoldProduct extends Model
{
    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
}
