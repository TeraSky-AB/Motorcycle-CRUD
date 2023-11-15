<?php
    require_once('model/Motorbike.php');
    require_once('model/MotorbikeBuilder.php');

    class View
    {
        private $title;
        private $content;
        private $router;

        public function __construct(Router $router)
        {
            $this->router = $router;
        }

        public function makeTestPage()
        {
            $this->title = "Page de test";
            $this->content = "<p>This is a page test. Don't mind it..</p>";
        }

        public function makeMotorbikePage(Motorbike $motorbike, $id=null)
        {
            $this->title = $motorbike->getBrand() . ' ' . $motorbike->getModel();
            $this->content = "<p>$motorbike</p>";
            $this->content .= '<input onclick="window.location.href = \'' . $this->router->getMotorbikeDeletionURL($id) . '\';"   type="button" value="Delete"/>'; 
            $this->content .= '<input onclick="window.location.href = \'' . $this->router->getMotorbikeModifyURL($id) . '\';"   type="button" value="Modify"/>'; 
        }

        public function makeErrorPage($title, $content)
        {
            $this->title = $title;
            $this->content = $content;
        }

        public function makeDebugPage($variable) {
            $this->title = 'Debug';
            $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
        }

        public function makeListPage($array)
        {
            $this->title = "Motorbike list";
            $this->content = '<h1>Motorbike list:</h1><ul>';
            foreach($array as $key => $value)
            {
                $this->content .= '<li><a href="' . $this->router->getMotorbikeURL($key) . '" >' . $value->getBrand() . ' ' . $value->getModel() . '</a></li>';
            }
            $this->content .= '</ul>';
        }

        public function makeMotorbikeCreationPage(MotorbikeBuilder $motorbike, $id=null)
        {
            $data = $motorbike->getData();
            $error = $motorbike->getError();
            $labels = array('Brand', 'Model', 'Color', 'Engine size', 'Manufacture year');
            $inputNames = array(MotorbikeBuilder::BRAND_REF, MotorbikeBuilder::MODEL_REF, MotorbikeBuilder::COLOR_REF, MotorbikeBuilder::CCS_REF, MotorbikeBuilder::MANU_YEAR_REF);
            $this->title = $id === null ? 'Motorbike creator': 'Motorbike modifying';
            $this->content = '<h1>' . ($id === null ? 'Motorbike creator': 'Motorbike modifying') . '</h1><form method="POST" action="' . ($id !== null ? $this->router->getMotorbikeSaveModificationsURL() : $this->router->getMotorbikeSaveURL()) . '">';
            for($i = 0; $i < count($labels); $i++)
            {
                $this->content .= '<label>' . $labels[$i] . '<input type=\"text\" name=' . $inputNames[$i] .' value=' . $data[$inputNames[$i]] . '></label>';
            }
            $this->content .= '<input type="submit" value="Submit" /></form>';
            $this->content .= '<p>* = Mandatory</p>';
            $this->content .= $error;
        }

        public function makeMotorbikeDeletionPage($id)
        {
            $this->title = 'Delete?';
            $this->content = "<h1>$this->title</h1><h2>Are you sure you want to delete it?</h2>";
            $this->content .= '<form method="POST"><input type="submit" value="Yes" /><input onclick="window.location.href = \'../../' . $this->router->getMotorbikeListURL() . '\';"   type="button" value="No"/></form>';
        }

        public function makeMotorbikeDeletedPage()
        {
            $this->title = 'Motorbike deleted';
            $this->content = '<h1>Deletion done with success</h1><p>This motorbike has been deleted !</p>';
        }

        public function makeCreatedMotorbikePage()
        {
            $this->title = 'Motorbike created';
            $this->content = '<h1>Creation done with success</h1><p>Motorbike created !</p>';
        }

        public function makeModifiedMotorbikePage()
        {
            $this->title = 'Motorbike modified';
            $this->content = '<h1>Motorbike modified with success</h1><p>Motorbike modified !</p>';
        }

        public function makeIndexPage()
        {
            $this->title = 'Homepage';
            $this->content = '<div class="showcase"><h1>Motorbike creation site !</h1>';
            $this->content .= '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vehicula, ex id pellentesque eleifend, sem turpis consequat velit, eget volutpat nisl nibh in tellus. Phasellus mollis, elit non iaculis suscipit.</p>';
            $this->content .= '</div>';
        }

        private function getNav()
        {
            return array(
                "Homepage" => $this->router->getHomepageURL(),
                "Motorbike list" => $this->router->getMotorbikeListURL(),
                "Create your motorbike !" => $this->router->getMotorbikeCreationURL()
            );
        }

        public function render()
        {
            if(!isset($this->title) && !isset($this->content))
            {
                $this->makeErrorPage('Value Error', 'No value in this view.');
            }
            $title = $this->title;
            $content = $this->content;
            include('templates/template.php');
        }
    }

?>