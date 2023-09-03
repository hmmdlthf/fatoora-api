<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/user/User.php";

class UserRepository extends Db
{
    protected string $table;

    public function __construct()
    {
        $this->setTable('user');
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setTable(string $table)
    {
        $this->table = $table;
    }

    public function addDetailsToModel(array $array)
    {
        $user = new User();
        $user->setId($array['id']);
        $user->setFname($array['fname']);
        $user->setLname($array['lname']);
        $user->setEmail($array['email']);
        $user->setUsername($array['username']);
        $user->setPassword($array['password']);
        $user->setToken($array['token']);
        $user->setUniqueId($array['unique_id']);
        $user->setNoAttempts($array['no_attempts']);
        $user->setCreatedDate($array['created_date']);
        $user->setLastLogin($array['last_login']);
        $user->setLastLogin($array['is_verified']);
        return $user;
    }

    public function findUserById(int $id)
    {
        
        $query = "SELECT * FROM ".  $this->getTable() ."WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findUserByEmail(string $email)
    {
        $query = "SELECT * FROM " . $this->getTable() ." WHERE `email`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findUsers()
    {
        $query = "SELECT * FROM ". $this->getTable() . " ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        return $resultSet;
    }

    public function save(User $user)
    {
        $query = "INSERT INTO " .  $this->getTable() . " (`fname`, `lname`, `email`, `username`, `password`, `token`, `unique_id`, `no_attempts`, `created_date`, `last_login`, `is_verified`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$user->getFname(), $user->getLname(), $user->getEmail(), $user->getUsername(), $user->getPassword(), $user->getToken(), $user->getNoAttempts(), $user->getCreatedDate(), $user->getLastLogin(), $user->getIsVerified()]);
        return true;
    }

    public function update(User $user)
    {
        $query = "UPDATE ". $this->getTable() ." SET `fname`=?, `lname`=?, `email`=? `username`=?, `password`=?, `token`=?, `unique_id`=?, `no_attempts`=?, `created_date`=?, `last_login`=?, `is_verified`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$user->getFname(), $user->getLname(), $user->getEmail(), $user->getPassword(), $user->getToken(), $user->getUniqueId(), $user->getNoAttempts(), $user->getLastLogin(), $user->getIsVerified(), $user->getId()]);
        return true;
    }

    public function delete(User $user)
    {
        $query = "DELETE FROM ". $this->getTable() ." WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$user->getId()]);
    }
}