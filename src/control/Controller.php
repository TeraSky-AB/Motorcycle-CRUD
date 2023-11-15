<?php
    require_once('view/View.php');
    require_once('model/Motorbike.php');
    require_once('model/MotorbikeBuilder.php');
    require_once('model/MotorbikeStorage.php');

    class Controller
    {
        private $view;
        private $motorbikesStorage;

        public function __construct(View $view, MotorbikeStorage $storage)
        {
            $this->view = $view;
            $this->motorbikesStorage = $storage;
        }

        private static function arrayEntriesEscape($array)
        {
            foreach($array as $key => $value)
            {
                $array[$key] = htmlspecialchars($value, ENT_QUOTES|ENT_SUBSTITUTE|ENT_HTML5, 'UTF-8');
            }
            return $array;
        }


        public function saveNewMotorbike(array $data)
        {
            $data = $this::arrayEntriesEscape($data);
            $newMotorbike = new MotorbikeBuilder($data);
            if($newMotorbike->isValid())
            {
                $this->motorbikesStorage->create($newMotorbike->createMotorbike());
                $this->view->makeCreatedMotorbikePage();
            } else {
                $this->view->makeMotorbikeCreationPage($newMotorbike);
            }
        }

        public function askMotorbikeDeletion($id)
        {
            if($this->motorbikesStorage->exists($id))
            {
                $this->view->makeMotorbikeDeletionPage($id);
            } else {
                $this->view->makeErrorPage('Motorbike doesn\'t exist', "Motorbike with ID: $id doesn't exist.");
            }
        }

        public function deleteMotorbike($id)
        {
            $this->motorbikesStorage->delete($id);
            $this->view->makeMotorbikeDeletedPage();
        }

        public function modifyMotorbike($id)
        {
            $motorbike = $this->motorbikesStorage->read($id);
            $this->view->makeMotorbikeCreationPage(new MotorbikeBuilder(array(MotorbikeBuilder::BRAND_REF=>$motorbike->getBrand(), MotorbikeBuilder::MODEL_REF=>$motorbike->getModel(), MotorbikeBuilder::COLOR_REF=>$motorbike->getColor(), MotorbikeBuilder::CCS_REF=>$motorbike->getCCs(), MotorbikeBuilder::MANU_YEAR_REF=>$motorbike->getManufactureYear())), $id);
        }

        public function saveMotorbikeModifications($data, $id)
        {
            $data = $this::arrayEntriesEscape($data);
            $newMotorbike = new MotorbikeBuilder($data);
            if($newMotorbike->isValid())
            {
                $this->motorbikesStorage->update($id, $newMotorbike->createMotorbike());
                $this->view->makeModifiedMotorbikePage();
            } else {
                $this->view->makeMotorbikeCreationPage($newMotorbike);
            } 
        }

        public function showList()
        {
            $this->view->makeListPage($this->motorbikesStorage->readAll());
        }

        public function showInformation($id) {
            if($this->motorbikesStorage->exists($id))
            {
                $this->view->makeMotorbikePage($this->motorbikesStorage->read($id), $id);
            } else {
                $this->view->makeErrorPage('ID Error', 'Please change entered ID.');
            }
        }
    }
?>