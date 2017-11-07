<?php

namespace Base\AdminBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 * @package Base\AdminBundle\Service
 */
class FileUploader
{
    /**
     * @var string
     */
    private $targetDir;

    /**
     * FileUploader constructor.
     * @param $targetDir
     */
    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);
        return $fileName;
    }

    public function removeFile($fileName)
    {
        $file_path = $this->getTargetDir().'/'.$fileName;
        if(file_exists($file_path)) unlink($file_path);
    }

    /**
     * @return mixed
     */
    public function getTargetDir()
    {
        return $this->targetDir;
    }
}