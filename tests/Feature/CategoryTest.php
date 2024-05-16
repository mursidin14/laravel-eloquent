<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
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
                'name' => "Name $i"
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
                "name" => "Name"
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
}
