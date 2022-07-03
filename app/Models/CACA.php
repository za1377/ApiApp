<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
