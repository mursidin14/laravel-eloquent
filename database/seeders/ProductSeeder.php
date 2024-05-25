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

        $product2 = new Product();
        $product2->id = '2';
        $product2->name = 'sosis';
        $product2->description = 'product sosis';
        $product2->price = 1000;
        $product2->stock = 20;
        $product2->category_id = 'FOOD';
        $product2->save();
    }
}
