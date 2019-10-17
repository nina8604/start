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
    public $category_id;

    /**
     * @var array
     */
    public $gallery;


    /**
     * ProductDto constructor.
     * @param int $sku
     * @param string $name
     * @param string $slug
     * @param string $description
     * @param int $price
     * @param int $category_id
     * @param array $gallery
     */
    public function __construct(int $sku,
                                string $name,
                                string $slug,
                                string $description,
                                int $price,
                                int $category_id,
                                array $gallery = [])
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->gallery = $gallery;
    }

    /**
     * @return bool
     */
    public function hasFiles() : bool {
        return !empty($this->galerry);
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
            'category_id' => $this->category_id,
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
            Arr::get($attributes, 'category_id', '')
        );
    }
}
