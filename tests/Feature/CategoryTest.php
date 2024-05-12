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
}
