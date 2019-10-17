<?php

namespace App\Services;

use App\DTO\ProductDto;
use App\Models\Product;

class ProductItemService
{
    /**
     * @var Product
     */
    private $product;

    /**
     * ProductItemService constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct() : Product {
        return $this->product;
    }

    /**
     * @param ProductDto $productDto
     * @return $this
     */
    public function changeAttributes(ProductDto $productDto) : self {
        $this->product->fill($productDto->toArray());
        return $this;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function changeImage(string $fileName) : self {
        $this->product->picture->path = $fileName;
        return $this;
    }

    /**
     * @param $gallery
     * @return $this
     */
    public function changeImages($gallery) :self {
        foreach($gallery as $picture) {
            $this->changeImage($picture);
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function commitChanges() : self {
        $this->product->save();
        return $this;
    }
}
