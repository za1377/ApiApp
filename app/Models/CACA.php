<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Relations\HasOne;

class CACA extends Model
{
    use HasFactory , SoftDeletes;

    /**
     * fillable
     *
     * @var array<bigInteger , bigInteger>
     */
    protected $fillable= [
        'cate_atrre_cate_id',
        'attributes_id',
    ];

    /**
     * The attreVal that belong to the CACA
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attreVal(): BelongsToMany
    {
        return $this->belongsToMany(AttributesValues::class, 'attributes_values_caas', 'caa_id', 'attre_val_id');
    }

    /**
     * The attreType that belong to the CACA
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attreType(): BelongsToMany
    {
        return $this->belongsToMany(AttributesTypes::class, 'attributes_values_caas', 'caa_id', 'attre_type_id');
    }

    /**
     * Get the cate_attr_cate that owns the CACA
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cate_attr_cate(): BelongsTo
    {
        return $this->belongsTo(Categories_AttributesCategories::class, 'cate_atrre_cate_id');
    }

    /**
     * Get the CACA_attrType associated with the CACA
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function CACA_attrType(): HasOne
    {
        return $this->hasOne(AttributesTypes_caa::class, 'caa_id');
    }

    protected $table = 'c_a_c_a';
}
