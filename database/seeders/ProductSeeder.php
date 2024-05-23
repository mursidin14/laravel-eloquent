<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->id = '1';
        $product->name = 'indomie';
        $product->description = 'product indomie';
        $product->price = 3000;
        $product->stock = 10;
        $product->category_id = 'FOOD';
        $product->save();
    }
}
