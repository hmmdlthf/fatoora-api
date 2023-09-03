<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/admin/Admin.php";
require_once $ROOT . "/app/utils/boolean.php";

class AdminRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $admin = new Admin();
        $admin->setId($array['id']);
        $admin->setEmail($array['email']);
        $admin->setUsername($array['username']);
        $admin->setPassword($array['password']);
        $admin->setToken($array['token']);
        $admin->setUniqueId($array['unique_id']);
        $admin->setNoAttempts($array['no_attempts']);
        $admin->setCreatedDate($array['created_date']);
        $admin->setLastLogin($array['last_login']);
        $admin->setIsVerified($array['is_verified']);

        if (array_key_exists('fname', $array)) {
            $admin->setFname($array['fname']);
        }
        if (array_key_exists('lname', $array)) {
            $admin->setLname($array['lname']);
        }
        return $admin;
    }

    public function findAdminById(int $id)
    {
        $query = "SELECT * FROM `admin` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findAdminByEmail(string $email)
    {
        $query = "SELECT * FROM `admin` WHERE `email`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findAdminByUsername(string $username)
    {
        $query = "SELECT * FROM `admin` WHERE `username`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$username]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findAdmins()
    {
        $query = "SELECT * FROM `admin`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $admins = [];

        if ($resultSet > 0) {
            foreach ($resultSet as $adminArray) {
                $admin = $this->addDetailsToModel($adminArray);
                $admins[] = $admin;
            }
            return $admins;
        } else {
            false;
        }
        return $resultSet;
    }

    public function save(Admin $admin)
    {
        $query = "INSERT INTO `admin` (`email`, `token`, `username`, `password`, `unique_id`, `no_attempts`, `created_date`, `last_login`, `is_verified`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$admin->getEmail(), $admin->getToken(), $admin->getUsername(), $admin->getPassword(), $admin->getUniqueId(), $admin->getNoAttempts(), $admin->getCreatedDate(), $admin->getLastLogin(), getTinyInt($admin->getIsVerified())]);
        return true;
    }

    public function update(Admin $admin)
    {
        $query = "UPDATE `admin` SET `fname`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$admin->getFname(), $admin->getId()]);
        return true;
    }

    public function delete(Admin $admin)
    {
        $query = "DELETE FROM `admin` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$admin->getId()]);
    }

    public function verify(Admin $admin)
    {
        $query = "UPDATE `admin` SET `is_verified`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$admin->getIsVerified(), $admin->getId()]);
        return true;
    }

    public function updateLastLogin(Admin $admin)
    {
        $query = "UPDATE `admin` SET `last_login`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$admin->getLastLogin(), $admin->getId()]);
        return true;
    }
}
