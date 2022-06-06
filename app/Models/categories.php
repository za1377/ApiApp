<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array<bigInteger, bigInteger>
     */
    protected $fillable= [
        'name',
        'slug',
        'parent_id',
    ];

}
