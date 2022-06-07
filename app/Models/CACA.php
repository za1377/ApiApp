<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CACA extends Model
{
    use HasFactory;

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
}
