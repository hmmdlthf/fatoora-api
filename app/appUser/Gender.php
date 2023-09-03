<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

enum Gender: string
{
    CASE MALE = 'm';
    CASE FEMALE = 'f';
}

function getGenderFromSelect(string $gender)
    {
        if ($gender == Gender::MALE) {
            return Gender::MALE;
        } else if ($gender == Gender::FEMALE) {
            return Gender::FEMALE;
        } else {
            return null;
        }
    }