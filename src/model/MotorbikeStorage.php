<?php
    require_once('model/Motorbike.php');

    interface MotorbikeStorage
    {
        public function read($id);

        public function readAll();

        public function create(Motorbike $motorbike);

        public function delete($id);
    }
?>