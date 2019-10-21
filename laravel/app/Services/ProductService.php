<?php

namespace App\Services;

use App\DTO\ProductDto;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductService
{
    /**
     * @param Product $product
     * @param ProductDto $productDto
     * @return Product
     * @throws \Exception
     */
    protected function saveProduct(Product $product, ProductDto $productDto) : Product {
        $productItemService = new ProductItemService($product);

        if($productDto->hasNewFiles()) {
            $productItemService->addImages($productDto->gallery);
        }

        if($productDto->hasToDeleteFiles()) {
            $productItemService->deleteImages($productDto->picturesIdToDelete);
        }

        $productItemService
            ->changeAttributes($productDto)
            ->commitChanges();

        return $productItemService->getProduct();
    }

    /**
     * @param ProductDto $productDto
     * @return Product
     * @throws \Exception
     */
    public function createProduct(ProductDto $productDto) : Product {
        return $this->saveProduct(new Product(), $productDto);
    }

    /**
     * @param Product $product
     * @param ProductDto $productDto
     * @return Product
     * @throws \Exception
     */
    public function updateProduct(Product $product, ProductDto $productDto) : Product {
        return $this->saveProduct($product, $productDto);
    }
}
