<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class CategoryDto
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $alias;

    /**
     * @var string
     */
    public $description;

    /**
     * @var UploadedFile
     */
    public $uploadedFile;

    /**
     * CategoryDto constructor.
     *
     * @param string $name
     * @param string $alias
     * @param string $description
     * @param UploadedFile $uploadedFile
     */
    public function __construct(string $name,
                                string $alias,
                                string $description,
                                UploadedFile $uploadedFile = null)
    {
        $this->name = $name;
        $this->alias = $alias;
        $this->description = $description;
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @return bool
     */
    public function hasFile() : bool {
        return !empty($this->uploadedFile);
    }

    /**
     * @return array
     */
    public function toArray() : array {
        return [
            'name' => $this->name,
            'slug' => $this->alias,
            'description' => $this->description,
        ];
    }

    /**
     * @param array $attributes
     * @return static
     */
    public static function createFromArray(array $attributes) : self {
        return new self(
            Arr::get($attributes, 'name', ''),
            Arr::get($attributes, 'slug', ''),
            Arr::get($attributes, 'description', ''),
            Arr::get($attributes, 'file', null)
        );
    }
}
