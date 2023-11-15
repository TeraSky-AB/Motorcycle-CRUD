<?php
    require_once('model/Animal.php');

    interface AnimalStorage
    {
        public function read($id);

        public function readAll();

        public function create(Animal $animal);

        public function delete($id);
    }
?>