<?php

namespace App\Models;

use App\Helpers\AssetFilePath;
use App\Helpers\IModelFileManager;
use App\Helpers\ModelFileManagerTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Traits\PictureTrait;

/**
 * Class Category
 * @package App\Models
 *
 * @property string $file_name
 * @property Product[]|Collection $products
 */
class Category extends Model implements IModelFileManager
{
//    use AssetFilePath;
//    use PictureTrait;

    use ModelFileManagerTrait;

    const PICTURE_PATH = 'images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'file_name',
    ];

    public function products(){
        return $this
            ->hasmany(Product::class, 'category_id', 'id')
            ->orderBy('id', 'asc');
    }

    public function getFolderPath(): string
    {
        return self::PICTURE_PATH;
    }

    public function getFileName(): string
    {
        return $this->file_name;
    }

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::deleting(function ($category) {
//
//            $dir = $category->getFolderPath();
//            $category->deletePictureFromFolder($category->file_name, $dir);
//        });
//    }
}
