<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;

     /**
     * fillable
     *
     * @var array<string, string>
     */
    protected $fillable= [
        'name',
        'slug',
    ];

    /**
     * The cate_attrcate that belong to the Attributes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cate_attrcate(): BelongsToMany
    {
        return $this->belongsToMany(Categories_AttributesCategories::class, 'c_a_c_a', 'attributes_id', 'cate_atrre_cate_id');
    }
}
