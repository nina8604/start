<?php

namespace App\Observers;

use App\Models\Picture;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  \App\Models\Product $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Models\Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the category "deleting" event.
     *
     * @param  Product $product
     * @return bool
     */
    public function deleting(Product $product) {
        $product->pictures->each(function($picture){
            /* @var Picture $picture*/
            $picture->delete();
        });
        return true;
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Models\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the category "restored" event.
     *
     * @param  \App\Models\Product $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  \App\Models\Product $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
