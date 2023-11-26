<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Book::factory(33)->create()->each(function ($book){
            $numReviews = random_int(5,30);

            \App\Models\Review::factory()->count($numReviews)->goodReview()->for($book)->create();
        });

        \App\Models\Book::factory(33)->create()->each(function ($book){
            $numReviews = random_int(5,30);

            \App\Models\Review::factory($numReviews)->averageReview()->for($book)->create();
        });

        \App\Models\Book::factory(34)->create()->each(function ($book){
            $numReviews = random_int(5,30);

            \App\Models\Review::factory($numReviews)->badReview()->for($book)->create();
        });
    }
}
