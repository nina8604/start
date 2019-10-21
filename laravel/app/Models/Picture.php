<?php

namespace App\Models;

use App\Helpers\IModelFileManager;
use App\Helpers\ModelFileManagerTrait;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model implements IModelFileManager
{
    use ModelFileManagerTrait;

    const PICTURE_PATH = 'products';

    public function getFolderPath(): string
    {
        return self::PICTURE_PATH;
    }

    public function getFileName(): string
    {
        return $this->path;
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
