<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/file/File.php';

class FileDirectory
{
    private $uploadStatus;
    private $allowedSize;
    private Array $allowedExtensions;

    public function __construct()
    {
        $this->uploadStatus = false;
        $this->allowedSize = 500000;
        $this->allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    }

    public function getAllowedExtensions()
    {
        return $this->allowedExtensions;
    }

    public function setAllowedExtensions(array $extensions)
    {
        $this->allowedExtensions = $extensions;
    }

    public function isFileTrue(File $file)
    {
        return true;
    }

    public function isFileNotExists(File $file)
    {
        if (file_exists($file->getTargetFile())) {
            echo "Sorry, file already exists. <br>";
            return false;
        } return true;
    }

    public function checkFileSize(File $file)
    {
        if ($file->getSize() > $this->allowedSize) {
            echo "Sorry, your file is too large. <br>";
            return false;
        }
        return true;
    }

    public function ckeckFileExtension(File $file)
    {
        foreach($this->allowedExtensions as $extension) {
            if ($file->getExtension() == $extension) {
                return true;
            }
        }
        echo "Sorry, only ";
        foreach($this->allowedExtensions as $extension) {
            echo ($extension);
            echo ", ";
        }
        echo "files are allowed. <br>";
        return false;
    }

    public function moveUploadedFile(File $file)
    {
        if (move_uploaded_file($file->getTmpName(), $file->getTargetFile())) {
            echo "The file " . htmlspecialchars(basename($file->getName())) . " has been uploaded. <br>";
            return true;
        } else {
            echo "Sorry, there was an error moving your file. <br>";
            return false;
        }
    }

    public function uploadFile(File $file)
    {
        if ($this->isFileTrue($file) && $this->isFileNotExists($file) && $this->checkFileSize($file) && $this->ckeckFileExtension($file) && $this->moveUploadedFile($file)) 
        {
            echo "Successfull <br>";
            $this->uploadStatus = true;
            return $this->uploadStatus;
        } else {
            echo "Sorry, there was an error uploading your file. <br>";
            return $this->uploadStatus;
        }
        
        
    }
}
