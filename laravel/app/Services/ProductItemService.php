<?php

namespace App\Services;

use App\DTO\ProductDto;
use App\Helpers\PromiseActionsTrait;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

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
     * @param array $ordering
     * @return void
     * @throws \Exception
     */
    public function addImages(array $gallery, array $ordering) {
        $this->recordPromiseAction(function() use($gallery, $ordering) {
            foreach($gallery as $orderNumber => $uploadedImage) {
                $newPicture = new Picture();
                $pictureService = new PictureService($uploadedImage);
                $newPicture->path = $pictureService->storeToFolder($newPicture->getFolderPath());
                $newPicture->ordering = $ordering[$orderNumber];

                // $newPicture->product_id = $this->product->id;
                // $newPicture->save();

                $this->product->pictures()->save($newPicture);
            }
        });
    }

    /**
     * @param array $picturesIdToDelete
     */
    public function deleteImages(array $picturesIdToDelete) {
        $this->recordPromiseAction(function() use($picturesIdToDelete) {
            /* @var Collection|Picture[] $deletingPictures */
            $deletingPictures = $this->product->pictures()
                ->whereIn('id', $picturesIdToDelete)
                ->get();

            $deletingPictures->each(function($picture) {
                /* @var Picture $picture */
                $picture->delete();
            });
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
