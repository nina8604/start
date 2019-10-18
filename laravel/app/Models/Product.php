<?php

namespace App\Models;

use App\Helpers\IModelFileManager;
use App\Helpers\ModelFileManagerTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Product
 * @package App\Models
 *
 * @property Category $category
 * @property Picture[]|Collection $pictures
 * @property Picture $picture
 */
class Product extends Model implements IModelFileManager
{
//    const PICTURE_PATH = 'products';

    use ModelFileManagerTrait;

    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function pictures() {
        return $this->hasmany(Picture::class, 'product_id', 'id');
    }

    public function picture() {
        return $this->hasOne(Picture::class,'product_id','id');
    }

    public function getFolderPath(): string
    {
        return Picture::PICTURE_PATH;
    }

    public function getFileName(): string
    {
        return $this->picture->path;
    }


}
