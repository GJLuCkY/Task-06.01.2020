<?php

use App\Product;
use App\Category;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Tag::class, 50)->create()->each(function ($tag) {
            $categoryIds = Category::take(2)->inRandomOrder()->pluck('id')->toArray();
            $productsIds = Product::take(5)->inRandomOrder()->pluck('id')->toArray();
            $tag->products()->sync($productsIds);
            $tag->categories()->sync($categoryIds);
        });
    }
}
