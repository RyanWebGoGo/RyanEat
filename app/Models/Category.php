<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'sorting',
        'image',
        'slug',
        'is_display'
    ];

    protected $casts = [
        'is_display' => 'boolean',
        'sorting' => 'integer'
    ];

    protected $attributes = [
        'sorting' => 0,
        'is_display' => true
    ];

    public function scopeDisplayed($query)
    {
        return $query->where('is_display', true);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = \Str::slug($value);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

}
