<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static create(array $inputs)
 * @method static findOrFail($id)
 * */
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
    ];
}
