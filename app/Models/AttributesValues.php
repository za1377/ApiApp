<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributesValues extends Model
{
    use HasFactory , SoftDeletes;

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
     * The caca that belong to the AttributesValues
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function caca(): BelongsToMany
    {
        return $this->belongsToMany(CACA::class, 'attributes_values_caas', 'attre_val_id', 'caa_id');
    }
}
