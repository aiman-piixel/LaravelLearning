<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "book_id"=> null,
            "review"=> fake()->paragraph,
            "rating"=> fake()->numberBetween(1,5),
            "created_at"=> fake()->dateTimeBetween("-2 years"),
            "updated_at"=> fake()->dateTimeBetween("-2 years","now")
        ];
    }
    public function goodReview()
    {
        return $this->state(function (array $attributes) {
            return [
                "rating"=> fake()->numberBetween(4,5)
            ];
        });
    }

    public function averageReview()
    {
        return $this->state(function (array $attributes) {
            return [
                "rating"=> fake()->numberBetween(2,5)
            ];
        });
    }
    
    public function badReview()
    {
        return $this->state(function (array $attributes) {
            return [
                "rating"=> fake()->numberBetween(1,3)
            ];
        });
    }
}
