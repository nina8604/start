<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class ProductDto
{
    /**
     * @var int
     */
    public $sku;
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $price;

    /**
     * @var int
     */
    public $categoryId;

    /**
     * @var UploadedFile[]|array
     */
    public $gallery;

    /**
     * @var array
     */
    public $picturesIdToDelete;

    /**
     * @var array
     */
    public $ordering;


    /**
     * ProductDto constructor.
     * @param int $sku
     * @param string $name
     * @param string $slug
     * @param string $description
     * @param int $price
     * @param int $categoryId
     * @param UploadedFile[]|array $gallery
     * @param array $picturesIdToDelete
     * @param array $ordering
     */
    public function __construct(int $sku,
                                string $name,
                                string $slug,
                                string $description,
                                int $price,
                                int $categoryId,
                                array $gallery = [],
                                array $picturesIdToDelete = [],
                                array $ordering = [])
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->price = $price;
        $this->categoryId = $categoryId;
        $this->gallery = $gallery;
        $this->picturesIdToDelete = $picturesIdToDelete;
        $this->ordering = $ordering;
    }

    /**
     * @return bool
     */
    public function hasNewFiles() : bool {
        return !empty($this->gallery);
    }

    /**
     * @return bool
     */
    public function hasToDeleteFiles() : bool {
        return !empty($this->picturesIdToDelete);
    }

    /**
     * @return array
     */
    public function toArray() : array {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->categoryId,
            'ordering' => $this->ordering,
        ];
    }

    /**
     * @param array $attributes
     * @return static
     */
    public static function createFromArray(array $attributes) : self {
        return new self(
            Arr::get($attributes, 'sku', ''),
            Arr::get($attributes, 'name', ''),
            Arr::get($attributes, 'slug', ''),
            Arr::get($attributes, 'description', ''),
            Arr::get($attributes, 'price', ''),
            Arr::get($attributes, 'category_id', ''),
            Arr::wrap(Arr::get($attributes, 'gallery', [])),
            Arr::get($attributes, 'pictures_id', []),
            Arr::get($attributes, 'ordering', [])
        );
    }
}
