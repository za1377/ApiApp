<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributesTypes_caa extends Model
{
    use HasFactory ,SoftDeletes;

    /**
     * fillable
     *
     * @var array<bigInteger , bigInteger>
     */
    protected $fillable= [
        'caa_id',
        'attribute_type_id',
    ];

    /**
     * Get the attrType that owns the AttributesTypes_caa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attrType(): BelongsTo
    {
        return $this->belongsTo(AttributesTypes::class, 'attribute_type_id');
    }
}
