<?php

namespace App\Services;

use App\DTO\ProductDto;
use App\Helpers\PromiseActionsTrait;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductItemService
{
    use PromiseActionsTrait;

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
     * @param UploadedFile[]|array $gallery
     * @return void
     * @throws \Exception
     */
    public function addImages(array $gallery) {
        $this->recordPromiseAction(function() use($gallery) {
            foreach($gallery as $uploadedImage) {
                $newPicture = new Picture();
                $pictureService = new PictureService($uploadedImage);
                $newPicture->path = $pictureService->storeToFolder($newPicture->getFolderPath());

                // $newPicture->product_id = $this->product->id;
                // $newPicture->save();

                $this->product->pictures()->save($newPicture);
            }
        });
    }

    /**
     * @return $this
     */
    public function commitChanges() : self {
        $this->product->save();

        $this->releasePromiseActions();

        return $this;
    }
}
