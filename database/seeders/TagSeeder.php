<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags=["DIY","Interviews","Inspiration","TipsAndTricks","BeginnersGuide","CaseStudy","Infographics","HealthTips","TechNews","TravelAdventure"];
        $arr=[];
        foreach($tags as $tag){
            $arr[]=[
                "tag_name"=>$tag,
                "created_at"=>now(),
                "updated_at"=>now()
            ];
        }
        Tag::insert($arr);
    }
}
