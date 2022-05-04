<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'comment' => $this->faker->sentence(),
            'user_id' => $this->faker->numberBetween(1, 5),
            'article_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
