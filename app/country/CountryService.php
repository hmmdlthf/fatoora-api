<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/country/Country.php';
require_once $ROOT . '/app/country/CountryRepository.php';

class CountryService
{
    private CountryRepository $countryRepository;

    public function __construct()
    {
        $this->countryRepository = new CountryRepository();
    }

    public function getCountryById(int $countryId)
    {
        return $this->countryRepository->findCountryById($countryId);
    }

    public function getCountryByName(string $name)
    {
        return $this->countryRepository->findCountryByName($name);
    }

    public function getCountries()
    {
        return $this->countryRepository->findCountries();
    }

    public function save($name)
    {
        if ($this->getCountryByName($name) !== false) {
            echo ("country already exists");
            return false;
        }   
        $country = new Country();
        $country->setName($name);
        $this->countryRepository->save($country);
    }

    public function update($id, $name)
    {
        $country = $this->getCountryById($id);
        if ($country == false) {
            echo ("country not found");
            return false;
        }
        $country->setName($name);
        $this->countryRepository->update($country);
    }

    public function delete($id)
    {
        $country = $this->getCountryById($id);
        if ($country == false) {
            echo ("country not found");
            return false;
        }
        $this->countryRepository->delete($country);
    }

    public function count()
    {
        return $this->countryRepository->count();
    }
}