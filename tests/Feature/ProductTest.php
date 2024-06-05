<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Voucher;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\VoucherSeeder;
use GuzzleHttp\Handler\Proxy;
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

    public function testPolimorphMany()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, VoucherSeeder::class, CommentSeeder::class]);

        $product = Product::query()->find('1');
        self::assertNotNull($product);

        $comments = $product->comments;
        foreach($comments as $comment) {
            self::assertEquals(Product::class, $comment->commentable_type);
            self::assertEquals($product->id, $comment->commentable_id);
        }
    }

    public function testConditionOfMorphMany()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, VoucherSeeder::class, CommentSeeder::class]);

        $product = Product::query()->first();
        self::assertNotNull($product);

        $comment = $product->commentLatestMany;
        self::assertNotNull($comment);

        $comment = $product->commentOldestMany;
        self::assertNotNull($comment);
    }

    public function testManyToManyPolihMorp()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, VoucherSeeder::class, TagSeeder::class]);

        $product = Product::query()->find('1');
        self::assertNotNull($product);
        $tags = $product->tags;
        self::assertCount(1, $tags);

        foreach($tags as $tag) {
            self::assertNotNull($tag->id);
            self::assertNotNull($tag->name);

            $voucher = Voucher::query()->first();
            self::assertNotNull($voucher);
            $tags = $voucher->tags;
            self::assertCount(1, $tags);
        }
    }
}
