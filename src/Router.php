<?php
    require_once('control/Controller.php');
    require_once('view/View.php');
    require_once('model/MotorbikeStorageFile.php');
    require_once('model/MotorbikeBuilder.php');

    class Router
    {
        private const PATH_HELPER = '/TW3/exoMVCR/animaux.php/';

        public function main()
        {
            $view = new View($this);
            $storage = new MotorbikeStorageFile('motorbike_db.txt');
            $ctr = new Controller($view, $storage);
            if(isset($_SERVER['PATH_INFO']))
            {
                $path_tab = explode('/', $_SERVER['PATH_INFO']);
                switch($path_tab[1])
                {
                    case 'about':
                        //$view->makeAboutPage(); #A créer
                        break;
                    case 'list':
                        $ctr->showList();
                        break;
                    case 'new':
                        $view->makeMotorbikeCreationPage(new MotorbikeBuilder());
                        break;
                    case 'saveNew':
                        $ctr->saveNewMotorbike($_POST);
                        break;
                    default:
                        $id = $path_tab[1];
                        if(isset($path_tab[2]))
                        {
                            switch($path_tab[2])
                            {
                                case 'confirmDeletion':
                                    
                                    break;
                                case 'delete':
                                    if($_SERVER['REQUEST_METHOD'] === 'GET')
                                    {
                                        $ctr->askMotorbikeDeletion($id);
                                    } else {
                                        $ctr->deleteMotorbike($id);
                                    }
                                    break;
                                case 'modify':
                                    $ctr->modifyMotorbike($id);
                                    break;
                                case 'saveModifications':
                                    $ctr->saveMotorbikeModifications($_POST, $id);
                                    break;
                                default:
                                    $view->makeErrorPage('404 Error', '404 Page not found: '.$path_tab[2]); #Penser à créer un objet Error
                                    break;
                            }
                        } else {
                            $ctr->showInformation($id);
                        }
                        break;
                }
            } else {
                $view->makeIndexPage(); #A créer
            }
            $view->render();
        }

        public function getMotorbikeModifyURL($id)
        {
            return "$id/modify";
        }

        public function getMotorbikeSaveModificationsURL()
        {
            return "saveModifications";
        }

        public function getMotorbikeListURL()
        {
            return 'list';
        }

        public function getMotorbikeURL($id)
        {
            return $id;
        }

        public function getHomepageURL()
        {
            return '.';
        }

        public function getMotorbikeCreationURL()
        {
            return 'new';
        }

        public function getMotorbikeSaveURL()
        {
            return 'saveNew';
        }

        public function getMotorbikeAskDeletionURL($id)
        {
            return "$id/confirmDeletion";
        }

        public function getMotorbikeDeletionURL()
        {
            return "delete";
        }
    }
?>