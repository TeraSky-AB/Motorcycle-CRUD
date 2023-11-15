<?php
    require_once('AnimalStorage.php');

    class AnimalStorageStub implements AnimalStorage
    {
        private $animalsTab;

        public function __construct()
        {
            $this -> animalsTab = array(
                'medor' => new Animal('Médor', 'chien', 12),
                'felix' => new Animal('Félix', 'chat', 4),
                'denver' => new Animal('Denver', 'dinosaure', 800),
                'booba' => new Animal('Booba', 'ours', 44)
            );
        }

        public function read($id)
        {
            return $this->animalsTab[$id];
        }

        public function readAll()
        {
            return $this->animalsTab;
        }
    }
?>