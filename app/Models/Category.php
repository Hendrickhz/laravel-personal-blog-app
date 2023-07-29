<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=["category_name",'category_slug'];
    use HasFactory;

    public function articles()
    {
         return $this->hasMany(Article::class);
    }
}
