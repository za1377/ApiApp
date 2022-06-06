<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array<bigInteger, bigInteger>
     */
    protected $fillable= [
        'name',
        'slug',
    ];

    /**
     * The categories that belong to the Brands
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(categories::class, 'brands_categories', 'brand_id', 'category_id');
    }
}
