<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = new Tag();
        $tag->id = 'tes';
        $tag->name = 'testing';
        $tag->save();

        $product = Product::query()->find('1');
        $product->tags()->attach($tag);

        $voucher = Voucher::query()->first();
        $voucher->tags()->attach($tag);
    }
}
