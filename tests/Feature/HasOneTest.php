<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Image;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\VirtualAccountSeeder;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HasOneTest extends TestCase
{
    public function testHasOne()
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class]);
        
        $customer = Customer::query()->find('UDIN');
        self::assertNotNull($customer);

        $wallet = $customer->wallet;
        self::assertNotNull($wallet);

        self::assertEquals(200000, $wallet->amount);
    }

    public function testHasOneTrought()
    {
        $this->seed([CustomerSeeder::class, WalletSeeder::class, VirtualAccountSeeder::class]);

        $customer = Customer::query()->find('UDIN');
        self::assertNotNull($customer);

        $virtualaccount = $customer->virtualAccount;
        self::assertNotNull($virtualaccount);
        self::assertEquals('BRI', $virtualaccount->bank);
    }

    public function testManyToMany()
    {
        $this->seed([CategorySeeder::class, CustomerSeeder::class, ProductSeeder::class]);

        $customer = Customer::query()->find('UDIN');
        self::assertNotNull($customer);

        $customer->customerLikes()->attach('1');

        $products = $customer->customerLikes;
        self::assertCount(1, $products);

        self::assertEquals('1', $products[0]->id);
    }

    public function testDiskLikeManyToMany()
    {
        $this->seed([CategorySeeder::class, CustomerSeeder::class, ProductSeeder::class]);

        $customer = Customer::query()->find('UDIN');
        self::assertNotNull($customer);

        $customer->customerLikes()->detach('1');

        $products = $customer->customerLikes;
        self::assertCount(0, $products);
    }

    public function testManyToManyAttribute()
    {
        $this->testManyToMany();

        $customer = Customer::query()->find('UDIN');
        $products = $customer->customerLikes;

        foreach($products as $product){
            $pivot = $product->pivot;

            self::assertNotNull($pivot);
            self::assertNotNull($pivot->customer_id);
            self::assertNotNull($pivot->product_id);
            self::assertNotNull($pivot->created_at);
        }
    }

    public function testManyToManyCondition()
    {
        $this->testManyToMany();

        $customer = Customer::query()->find('UDIN');
        $products = $customer->customerLikesLastMont;

        foreach($products as $product) {
            $pivot = $product->pivot;

            self::assertNotNull($pivot); 
            self::assertNotNull($pivot->customer_id);
            self::assertNotNull($pivot->product_id);
            self::assertNotNull($pivot->created_at);
        }
    }

    public function testPolimorphOne()
    {
        $this->seed([CustomerSeeder::class, ImageSeeder::class]);

        $customer = Customer::query()->find('UDIN');
        self::assertNotNull($customer);

        $image = $customer->customerImage;
        self::assertNotNull($image);

        self::assertEquals('https://testing.com/image/1.png', $image->url);
    }

    public function testEigerLoading()
    {
        $this->seed([CustomerSeeder::class, ImageSeeder::class, WalletSeeder::class]);

        $customer = Customer::query()->with(['customerImage', 'wallet'])->find('UDIN');
        self::assertNotNull($customer);
    }
}
