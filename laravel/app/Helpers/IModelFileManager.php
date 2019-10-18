<?php

namespace App\Helpers;

interface IModelFileManager
{
    public function getFolderPath() : string;

    public function getFileName() : string;

    public function assetToAbsolute(string $fileName) : string;

    public function deleteFile() : bool;

    public function deleteFileByName(string $fileName) : bool;
}
