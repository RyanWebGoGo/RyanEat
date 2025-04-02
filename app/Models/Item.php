<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'discount_price',
        'image',  //cover image , more image in item_photos
        'time_for_cook',
        'sorting',
        'is_display',
        'is_featured',
        'is_veg',
        'is_spicy'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_display' => 'boolean',
        'is_featured' => 'boolean',
        'is_veg' => 'boolean',
        'is_spicy' => 'boolean'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ItemImage::class);
    }
}
