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
}
