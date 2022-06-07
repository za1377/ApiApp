<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandsCategories extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array<bigInteger , bigInteger>
     */
    protected $fillable= [
        'brand_id',
        'category_id',
    ];
}
