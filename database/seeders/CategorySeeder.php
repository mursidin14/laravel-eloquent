<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        $category = new Category();
        $category->id = 'FOOD';
        $category->name = 'food';
        $category->description = 'Food category';
        $category->save();
    }
}
