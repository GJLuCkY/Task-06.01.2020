<?php

use App\Product;
use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Filter::class, 3)->create()->each(function ($filter) {
            factory(\App\Value::class, 4)->create(['filter_id' => $filter->id])->each(function ($value) {
                $productsIds = Product::take(5)->inRandomOrder()->pluck('id')->toArray();
                $value->products()->sync($productsIds);
            });
        });
    }
}
