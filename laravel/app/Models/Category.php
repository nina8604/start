<?php

namespace App\Models;

use App\Helpers\AssetFilePath;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Category
 * @package App\Models
 *
 * @property string $file_name
 * @property Product[]|Collection $products
 */
class Category extends Model
{
    use AssetFilePath;

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
}
