<?php

use App\Product;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Category::class, 20)->create()->each(function ($category) {
            $productsIds = Product::take(5)->inRandomOrder()->pluck('id')->toArray();
            $category->products()->sync($productsIds);
        });
    }
}
