<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class PictureService {
    /**
     * @var UploadedFile
     */
    private $uploadedFile;

    /**
     * PictureService constructor.
     * @param UploadedFile $uploadedFile
     */
    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @param string $folderPath
     * @param array $options
     * @return string
     * @throws \Exception
     */
    public function storeToFolder(string $folderPath, array $options = []) : string {
        $options = empty($options) ? ['disk' => 'public'] : $options;
        $fileName = $this->createFileName();
        if($this->uploadedFile->storeAs($folderPath, $fileName, $options))
            return $fileName;

        throw new \Exception('Fail uploaded file.');
    }

    /**
     * @return string
     */
    protected function createFileName() : string {
        $extension = $this->uploadedFile->extension();
        $fileName = uniqid(time(), true).".{$extension}";
        return $fileName;
    }
}

