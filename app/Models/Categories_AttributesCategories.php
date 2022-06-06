<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories_AttributesCategories extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array<bigInteger , bigInteger>
     */
    protected $fillable= [
        'attre_cate_id',
        'category_id',
    ];
}
