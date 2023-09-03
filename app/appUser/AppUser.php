<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/user/User.php";
require_once $ROOT . "/app/appUser/Gender.php";
require_once $ROOT . "/app/city/City.php";

class AppUser extends User
{
    protected $address;
    protected $phone;
    protected $nic;
    protected $title;
    protected $dob;
    protected $gender;
    protected $maritalStatus;
    protected City|null $city;

    public function getAddress()
    {
        return $this->address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getNic()
    {
        return $this->nic;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    public function getCity()
    {
        if ($this->city != null) {
            return $this->city;
        }
        return 'no city';
    }

    public function setAddress(string|null $address)
    {
        $this->address = $address;
    }

    public function setPhone(int|null $phone)
    {
        $this->phone = $phone;
    }

    public function setNic(string|null $nic)
    {
        $this->nic = $nic;
    }

    public function setTitle(string|null $title)
    {
        $this->title = $title;
    }

    public function setDob(string|null $dob)
    {
        $this->dob = $dob;
    }

    public function setGender(Gender|null $gender)
    {
        $this->gender = $gender;
    }

    public function setMaritalStatus(bool|null $maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    public function setCity(City|null $city)
    {
        $this->city = $city;
    }
}
