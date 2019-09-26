<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';
    public function products(){
        return $this->hasmany(Product::class, 'category_id', 'id');
    }
}
