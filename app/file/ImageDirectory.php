<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/file/File.php";
require_once $ROOT . "/app/file/FileDirectory.php";

class ImageDirectory extends FileDirectory
{
    public function isFileTrue(File $file)
    {
        $check = getimagesize($file->getTmpName());
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ". <br>";
            return true;
        } else {
            echo "File is not an image. <br>";
            return false;
        }
    }
}
