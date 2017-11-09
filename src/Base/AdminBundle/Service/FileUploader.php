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
     */
    public function __construct()
    {
        $this->targetDir = "";
    }

    /**
     * @return string
     */
    public function getTargetDir()
    {
        return $this->targetDir;
    }

    /**
     * @param string $targetDir
     */
    public function setTargetDir($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        if(!empty($this->targetDir)) {
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getTargetDir(), $fileName);
            return $fileName;
        }
        return false;
    }

    public function removeFile($fileName)
    {
        if(!empty($this->targetDir)) {
            $file_path = $this->getTargetDir().'/'.$fileName;
            if(file_exists($file_path)) unlink($file_path);
            return true;
        }
        return false;
    }
}