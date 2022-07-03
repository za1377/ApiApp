<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributesTypes extends Model
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
     * The caca that belong to the AttributesTypes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function caca(): BelongsToMany
    {
        return $this->belongsToMany(CACA::class, 'attributes_types_caas', 'attre_type_id', 'caa_id');
    }
}
