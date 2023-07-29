<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories=["Technology","Travel","Health & Fitness","Fashion & Style","Personal Development","Parenting","Food & Cooking","Finance & Investing","Book Reviews","Home & Garden"];
        $arr=[];
        foreach($categories as $category){
            $arr[]=[
                "category_name"=>$category,
                "category_slug"=>Str::slug($category),
                "created_at"=>now(),
                "updated_at"=>now()
            ];
        }
        Category::insert($arr);
    }
}
