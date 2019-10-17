<?php

namespace App\Models;

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
class Product extends Model
{
    const PICTURE_PATH = 'products';

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


}
