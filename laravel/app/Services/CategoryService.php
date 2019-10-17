<?php

namespace App\Services;

use App\DTO\CategoryDto;
use App\Models\Category;
use Illuminate\Http\UploadedFile;

class CategoryService
{
    /**
     * @param Category $category
     * @param CategoryDto $categoryDto
     * @return Category
     * @throws \Exception
     */
    protected function saveCategory(Category $category, CategoryDto $categoryDto) : Category {
        $fileName = $category->file_name;
        if($categoryDto->hasFile())
            $fileName = $this->saveCategoryImage($categoryDto->uploadedFile);

        $categoryItemService = new CategoryItemService($category);
        $categoryItemService
            ->changeAttributes($categoryDto)
            ->changeImage($fileName)
            ->commitChanges();

        return $categoryItemService->getCategory();
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     * @throws \Exception
     */
    protected function saveCategoryImage(UploadedFile $uploadedFile) : string {
        $pictureService = new PictureService($uploadedFile);
        return $pictureService->storeToFolder(Category::PICTURE_PATH);
    }

    /**
     * @param CategoryDto $categoryDto
     * @return Category
     * @throws \Exception
     */
    public function createCategory(CategoryDto $categoryDto) : Category {
        return $this->saveCategory(new Category(), $categoryDto);
    }

    /**
     * @param Category $category
     * @param CategoryDto $categoryDto
     * @return Category
     * @throws \Exception
     */
    public function updateCategory(Category $category, CategoryDto $categoryDto) : Category {
        return $this->saveCategory($category, $categoryDto);
    }





}
