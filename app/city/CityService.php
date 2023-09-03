<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/city/CityRepository.php';
require_once $ROOT . '/app/state/StateService.php';

class CityService
{
    private CityRepository $cityRepository;

    public function __construct()
    {
        $this->cityRepository = new CityRepository;
    }

    public function getCityById(int $cityId)
    {
        return $this->cityRepository->findCityById($cityId);
    }

    public function getCityByName(string $name)
    {
        return $this->cityRepository->findCityByName($name);
    }

    public function getCities()
    {
        return $this->cityRepository->findCities();
    }

    public function save($name, $stateId)
    {
        if ($this->getCityByName($name) !== false) {
            echo ("city already exists");
            return false;
        }   
        $city = new City();
        $city->setName($name);
        $state = new StateService();
        $city->setState($state->getStateById($stateId));
        $this->cityRepository->save($city);
    }

    public function update($id, $name)
    {
        $city = $this->getCityById($id);
        if ($city == false) {
            echo ("city not found");
            return false;
        }
        $city->setName($name);
        $this->cityRepository->update($city);
    }

    public function delete($id)
    {
        $city = $this->getCityById($id);
        if ($city == false) {
            echo ("city not found");
            return false;
        }
        $this->cityRepository->delete($city);
    }

    public function count()
    {
        return $this->cityRepository->count();
    }
}