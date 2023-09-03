<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/city/City.php";
require_once $ROOT . "/app/state/StateService.php";

class CityRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $city = new City();
        $city->setId($array['id']);
        $city->setName($array['name']);
        $state = new StateService();
        $city->setState($state->getStateById($array['state_id']));
        return $city;
    }

    public function findCityById(int $id)
    {
        $query = "SELECT * FROM `city` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findCityByName(string $name)
    {
        $query = "SELECT * FROM `city` WHERE `name`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$name]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findCities()
    {
        $query = "SELECT * FROM `city`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $cities = [];

        if ($resultSet > 0) {
            foreach($resultSet as $stateArray) {
                $city = $this->addDetailsToModel($stateArray);
                $cities[] = $city;
            }
            return $cities;
        } else {
            return false;
        }
    }

    public function save(City $city)
    {
        $query = "INSERT INTO `city` (`name`, `state_id`) VALUES (?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$city->getName(), $city->getState()->getId()]);
        return true;
    }

    public function update(City $city)
    {
        $query = "UPDATE `city` SET `name`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$city->getName(), $city->getId()]);
        return true;
    }

    public function delete(City $city)
    {
        $query = "DELETE FROM `city` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$city->getId()]);
    }

    public function count()
    {
        $query = "SELECT COUNT(*) FROM `city`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetch();
        return $resultSet['COUNT(*)'];
    }
}