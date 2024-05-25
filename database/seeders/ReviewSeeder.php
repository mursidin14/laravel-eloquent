<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $review = new Review();
        $review->product_id = '1';
        $review->rating = 4;
        $review->customer_id = 'UDIN';
        $review->comment = 'sangat memuaskan';
        $review->save();

        $review = new Review();
        $review->product_id = '1';
        $review->rating = 3;
        $review->customer_id = 'UDIN';
        $review->comment = 'ini juga bagus';
        $review->save();

    }
}
