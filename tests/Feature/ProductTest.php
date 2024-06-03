<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testManyToOne()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $product = Product::query()->find('1');
        self::assertNotNull($product);

        $category = $product->category;
        self::assertNotNull($category);

        self::assertEquals('FOOD', $category->id);
    }

    public function testHasOneOfMany()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::query()->find('FOOD');
        self::assertNotNull($category);

        $cheapsetProduct = $category->cheapsetProduct;
        self::assertNotNull($cheapsetProduct);
        self::assertEquals('2', $cheapsetProduct->id);

        $mostExpansiveProduct = $category->mostExpansiveProduct;
        self::assertNotNull($mostExpansiveProduct);
        self::assertEquals('1', $mostExpansiveProduct->id);
    }

    public function testPolimorphOne()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, ImageSeeder::class]);

        $product = Product::query()->find('1');
        self::assertNotNull($product);

        $image = $product->productImage;
        self::assertNotNull($image);

        self::assertEquals('https://testing.com/image/2.png', $image->url);
    }
}
