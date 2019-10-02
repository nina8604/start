<?php

namespace App\Helpers;

trait AssetFilePath
{
    abstract public function getFolderPath() : string;

    public function assetToAbsolute(string $fileName) : string {
        $path = $this->getFolderPath();
        return asset("storage/{$path}/{$fileName}");
    }
}
