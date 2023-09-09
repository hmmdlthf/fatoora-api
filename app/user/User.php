<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class User extends Db
{
    public function getPasswordHash($login)
    {
        $query = "SELECT [login],[pswd] FROM [saudipos].[POS].[V_POS_Operator] WHERE [login] = '". $login ."'";

        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function checkForPassword($login, $password)
    {
        $passwordHashStored = $this->getPasswordHash($login)['pswd'];
        $passwordHash = hash("sha256", $password);

        if ($passwordHashStored == $passwordHash) {
            return true;
        } else {
            return false;
        }
    }
}