<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class,5)->create()->map(function ($cat,$i){
            factory(Product::class,25)->create()->map(function ($product) use($cat,$i){
                $product->category()->associate($cat)->save();
            });
        });
    }
}
