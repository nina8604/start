<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Category
 * @package App\Models
 *
 * @property Product[]|Collection $products
 */
class Category extends Model
{
    protected $primaryKey = 'id';
    public function products(){
        return $this
            ->hasmany(Product::class, 'category_id', 'id')
            ->orderBy('id', 'asc');
    }
}
