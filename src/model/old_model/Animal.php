<?php
    class Animal
    {
        private $name, $specy, $age;

        public function __construct($name, $specy, $age)
        {
            $this->name = $name;
            $this->specy = $specy;
            $this->age = $age;
        }

        public function __toString()
        {
            return $this->name;
        }

        public function getName() {return $this->name;}
        public function getSpecy() {return $this->specy;}
        public function getAge() {return $this->age;}
    }
?>