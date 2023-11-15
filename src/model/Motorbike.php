<?php
class Motorbike
{
    private $brand, $model, $color, $CCs, $manufactureYear;

    public function __construct($brand, $model, $color, $CCs, $year)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
        $this->CCs = $CCs;
        $this->manufactureYear = $year;
    }

    public function __toString()
    {
        return "$this->color $this->brand $this->model with " . $this->CCs . "cc from $this->manufactureYear";
    }

    public function getBrand() {return $this->brand;}
    public function getModel() {return $this->model;}
    public function getColor() {return $this->color;}
    public function getCCs() {return $this->CCs;}
    public function getManufactureYear() {return $this->manufactureYear;}
}