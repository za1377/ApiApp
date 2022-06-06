<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeCategories extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array<string,string>
     */
    protected $fillable= [
        'name',
        'slug',
    ];

    /**
     * The categories that belong to the AttributeCategories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(categories::class, 'categories__attributes_categories', 'attre_cate_id', 'category_id');
    }
}
