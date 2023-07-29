<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title=fake()->sentence();
        $para= fake()->paragraph(20);
        return [
            "title"=>$title,
            "article_slug"=>Str::slug($title),
            "full_text"=>$para,
            "article_excerpt"=>Str::words($para,100,'...'),
            "category_id"=>rand(1,10)
        ];
    }
}
