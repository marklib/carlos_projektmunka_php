<?php

class Car{
    private $carId;
    private $userId;
    private $name;
    private $brand;
    private $fuelType;
    private $condition;
    private $rentFrom;
    //private $picture;

    public function getCarId()
    {
        return $this->carId;
    }

    public function setCarId($carId)
    {
        $this->carId = $carId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getFuelType()
    {
        return $this->fuelType;
    }

    public function setFuelType($fuelType)
    {
        $this->fuelType = $fuelType;
    }

    public function getCondition()
    {
        return $this->condition;
    }

    public function setCondition($condition)
    {
        $this->condition = $condition;
    }

    public function getRentFrom()
    {
        return $this->rentFrom;
    }

    public function setRentFrom($rentFrom)
    {
        $this->rentFrom = $rentFrom;
    }

    public function getFuelTypeHun(){
        switch ($this->fuelType){
            case 'petrol':
                return 'benzin';

            case 'diesel':
                return 'dízel';

            case 'electric':
                return 'elektromos';

            case 'other':
                return 'egyéb';
        }
        return '';
    }

    public function getConditionHun(){
        switch ($this->condition){
            case 'perfect':
                return 'tökéletes';

            case 'normal':
                return 'normál';

            case 'bad':
                return 'rossz';

        }
        return '';
    }

    public function getPicture(){
        return $this->picture;
    }

    public function setPicture($picture){
        $this->picture = $picture;
    }
}