<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class File
{
    private $name;
    private $fullPath;
    private $type;
    private $tmpName;
    private $error;
    private $size;
    private $extension;
    private $targetDir;
    private $targetFile;

    public function __construct($name, $type, $fullPath, $tmpName, $error, $size, $targetDir)
    {
        $this->name = $name;
        $this->fullPath = $fullPath;
        $this->tmpName = $tmpName;
        $this->error = $error;
        $this->size = $size;
        $this->targetDir = $targetDir;
        $this->targetFile = $this->targetDir . basename($name);
        $this->type = $type;
        $this->extension = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFullPath()
    {
        return $this->fullPath;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTmpName(): string
    {
        return $this->tmpName;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }

    public function getTargetFile(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . $this->targetFile;
    }

    public function getShortFile(): string
    {
        return $this->targetFile;
    }

    public function getDownloadFile()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . $this->targetFile;
    }
}
