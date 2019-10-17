<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait PictureTrait {
    /**
     * @param string $pictureName
     * @param string $dir
     */
    public function deletePictureFromFolder($pictureName, $dir) {
        $picturePath = '/'.$dir.'/'.$pictureName;
        if (Storage::disk('public')->exists($picturePath)){
            Storage::disk('public')->delete($picturePath);
        }
    }
}
