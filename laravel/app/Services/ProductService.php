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

        $gallery = $product->pictures;
        if($productDto->hasFiles()) {
            $gallery = $this->saveProductImages($productDto->gallery);
        }

        $productItemService = new ProductItemService($product);
        $productItemService
            ->changeAttributes($productDto)
            ->changeImages($gallery)
            ->commitChanges();

        return $productItemService->getProduct();
    }

    /**
     * @param array $gallery
     * @return $this
     * @throws \Exception
     */
    protected function saveProductImages(array $gallery) {
        foreach($gallery as $picture) {
            $this->saveProductImage($picture);
        }
        return $this;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     * @throws \Exception
     */
    protected function saveProductImage(UploadedFile $uploadedFile) : string {
        $pictureService = new PictureService($uploadedFile);
        return $pictureService->storeToFolder(Product::PICTURE_PATH);
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
