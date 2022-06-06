<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
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
        'parent_id',
    ];

    /**
     * The brands that belong to the categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brands::class, 'brands_categories', 'category_id', 'brand_id');
    }
}
