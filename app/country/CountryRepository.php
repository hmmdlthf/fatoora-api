<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/country/Country.php";

class CountryRepository extends Db
{
    public function findCountryById(int $id)
    {
        $query = "SELECT * FROM `country` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();
        
        if ($resultSet > 0) {
            $country = new Country();
            $country->setId($id);
            $country->setName($resultSet['name']);
            return $country;
        } else {
            die("no country with id ". $id . "<br>");
            return false;
        }
    }

    public function findCountryByName(string $name)
    {
        $query = "SELECT * FROM `country` WHERE `name`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$name]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            $country = new Country();
            $country->setId($resultSet['id']);
            $country->setName($resultSet['name']);
            return $country;
        } else {
            return false;
        }
    }

    public function findCountries()
    {
        $query = "SELECT * FROM `country`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $countries = [];

        if ($resultSet > 0) {
            foreach($resultSet as $countryArray) {
                $country = new Country();
                $country->setId($countryArray['id']);
                $country->setName($countryArray['name']);
                $countries[] = $country;
            }
            return $countries;
        } else {
            return false;
        }
    }

    public function save(Country $country)
    {
        $query = "INSERT INTO `country` (`name`) VALUES (?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$country->getName()]);
        return true;
    }

    public function update(Country $country)
    {
        $query = "UPDATE `country` SET `name`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$country->getName(), $country->getId()]);
        return true;
    }

    public function delete(Country $country)
    {
        $query = "DELETE FROM `country` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$country->getId()]);
    }

    public function count()
    {
        $query = "SELECT COUNT(*) FROM `country`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetch();
        return $resultSet['COUNT(*)'];
    }
}