<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

trait ModelFileManagerTrait
{
    public function assetToAbsolute(string $fileName) : string {
        /* @var IModelFileManager|Model $this */
        $path = $this->getFolderPath();
        return asset("storage/{$path}/{$fileName}");
    }

    public function deleteFile() : bool {
        /* @var IModelFileManager|Model $this */
        $folderPath = $this->getFolderPath();
        $fileName = $this->getFileName();
        $filePath =  -dd;
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }

        return false;
    }

    public function deleteFileByName(string $fileName) : bool {
        // ....
    }
}
