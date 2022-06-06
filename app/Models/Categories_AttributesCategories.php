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

    /**
     * The attributes that belong to the Categories_AttributesCategories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attributes::class, 'c_a_c_a', 'cate_atrre_cate_id', 'attributes_id');
    }
}
