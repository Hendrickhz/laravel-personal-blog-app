<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=["title","full_text","article_slug","article_excerpt","img",'category_id','deleted_at'];

    public function category()
    {
       return $this->belongsTo(Category::class,'category_id');
    }
    public function tags()
    {
         return $this->belongsToMany(Tag::class);
    }
}
