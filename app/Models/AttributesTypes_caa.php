<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributesTypes_caa extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array<bigInteger , bigInteger>
     */
    protected $fillable= [
        'caa_id',
        'attre_type_id',
    ];
}
