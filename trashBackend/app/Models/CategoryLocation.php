<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryLocation extends Model
{
    public $timestamps = false;

    protected $table = 'category_location';

    protected $fillable = [
        Category::RELATION_STRING,
        Location::RELATION_STRING,
    ];
}
