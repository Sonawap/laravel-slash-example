<?php

namespace Database\Factories;
use App\Models\Article;

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
    protected $model = Article::class;
    public function definition()
    {
        return [
            'subject' => $this->faker->text($maxNbChars = 100),
            'tags' => json_encode(['politics', 'economy', 'business', 'money']),
            'user_id' => $this->faker->numberBetween(1, 5),
            'thumbnail' => 'https://i.pravatar.cc/150?img='.rand(10, 50),
            'image' => 'https://i.pravatar.cc/300?img='.rand(10, 50),
            'body' => $this->faker->sentence(500),
        ];
    }
}
