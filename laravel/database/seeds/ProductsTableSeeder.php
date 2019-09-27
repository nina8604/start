<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Picture;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(Product::class,50)->create();

        factory(Product::class,10)->create()->map(function ($prod,$i){
            factory(Picture::class,5)->create()->map(function ($picture) use($prod,$i){
                $picture->product()->associate($prod)->save();
            });
        });
    }
}
