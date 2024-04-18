<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $inputs)
 * @method static findOrFail($id)
 * */
class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

}
