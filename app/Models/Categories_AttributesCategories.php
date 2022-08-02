<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Categories_AttributesCategories extends Model
{
    use HasFactory , SoftDeletes;

    /**
     * fillable
     *
     * @var array<bigInteger , bigInteger>
     */
    protected $fillable= [
        'category_id',
        'attribute_category_id',
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

    /**
     * Get all of the CACA for the Categories_AttributesCategories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function CACA(): HasMany
    {
        return $this->hasMany(CACA::class, 'cate_atrre_cate_id', 'local_key');
    }
}
