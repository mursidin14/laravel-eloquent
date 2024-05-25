<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Scopes\isActiveGlobalScope;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ReviewSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    public function testInsert()
    {
        $category = new Category();
        $category->id = 'GADGED';
        $category->name = 'Gadged';
        $result = $category->save();

        self::assertTrue($result);
    }

    public function testInsertMany()
    {
        $categories = [];
        for($i = 0; $i < 10; $i++){
            $categories[] = [
                'id' => "ID $i",
                'name' => "Name $i",
                'is_active' => true,
            ];
        }

        // $result = Category::query()->insert($categories);
        $result = Category::insert($categories);

        self::assertTrue($result);

        // $total = Category::query()->count();
        $total = Category::count();
        self::assertEquals(10, $total);
    }

    public function testFind()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find('FOOD');
        self::assertNotNull($category);
        self::assertEquals('FOOD', $category->id);
        self::assertEquals('food', $category->name);
        self::assertEquals('Food category', $category->description);
    }

    public function testUpdate()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find('FOOD');
        $category->name = 'Food update';
        $result = $category->update();

        self::assertTrue($result);
    }

    public function testSelect()
    {
        for($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->id = "$i";
            $category->name = "Category $i";
            $category->is_active = true;
            $category->save();
        }

        $categories = Category::query()->whereNull('description')->get();
        self::assertEquals(5, $categories->count());
        $categories->each(function ($category) {
            self::assertNull($category->description);
        });
    }

    public function testUpdateMany()
    {
        $categories = [];
        for($i = 0; $i < 10; $i++){
            $categories[] = [
                "id" => "ID $i",
                "name" => "Name",
                "is_active" => true
            ];
        }

        $result = Category::insert($categories);
        self::assertTrue($result);

        Category::whereNull('description')->update([
            'description' => 'updated'
        ]);

        $total = Category::where('description', '=', 'updated')->count();
        self::assertEquals(10, $total);
    }

    public function testDelete()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find('FOOD');
        $result = $category->delete();

        self::assertTrue($result);

        $total = Category::count();
        self::assertEquals(0, $total);
    }

    public function testCreate()
    {
        $request = [
            'id' => 'mie',
            'name' => 'MIE',
            'description' => 'INDOMIE',
        ];

        $category = new Category($request);
        $category->save();
        self::assertNotNull($category->id);
    }

    public function testUpdateCategory()
    {
        $this->seed(CategorySeeder::class);

        $request = [
            'name' => 'food update',
            'description' => 'food category update'
        ];

        $category = Category::find('FOOD');
        $category->fill($request);
        $category->save();

        self::assertNotNull($category->id);
    }

    public function testAddGlobalScope()
    {
        $category = new Category();
        $category->id = 'MIE';
        $category->name = 'inter mie';
        $category->description = 'mie murah';
        $category->is_active = false;
        $category->save();

        $category = Category::query()->find('MIE');
        self::assertNull($category);

        $category = Category::query()->withoutGlobalScopes([isActiveGlobalScope::class])->find('MIE');
        self::assertNotNull($category);
    }

    public function testOneToMany()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::query()->find('FOOD');
        self::assertNotNull($category);

        $product = $category->products;
        self::assertNotNull($product);

        self::assertCount(2, $product);
    }

    public function testHasManyThroug()
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class, CustomerSeeder::class, ReviewSeeder::class]);

        $category = Category::query()->find('FOOD');
        self::assertNotNull($category);

        $reviews = $category->reviews;
        self::assertNotNull($reviews);
        self::assertCount(2, $reviews);
    }
}
