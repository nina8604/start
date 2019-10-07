<?php

namespace App\Services;

use App\DTO\CategoryDto;
use App\Models\Category;

class CategoryItemService
{
    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryItemService constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory() : Category {
        return $this->category;
    }

    /**
     * @param CategoryDto $categoryDto
     * @return $this
     */
    public function changeAttributes(CategoryDto $categoryDto) : self {
        $this->category->fill($categoryDto->toArray());
        return $this;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function changeImage(string $fileName) : self {
        $this->category->file_name = $fileName;
        return $this;
    }

    /**
     * @return $this
     */
    public function commitChanges() : self {
        $this->category->save();
        return $this;
    }
}
