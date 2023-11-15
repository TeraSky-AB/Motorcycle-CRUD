<?php
class AnimalBuilder
{
    private $data;
    private $error;
    public const NAME_REF = 'name';
    public const SPECIES_REF = 'specy';
    public const AGE_REF = 'age';

    public function __construct($data=null, $error=null)
    {
        if($data === null)
        {
            $this->data = array(self::NAME_REF=>'', self::SPECIES_REF=>'', self::AGE_REF=>'');
        } else {
            $this->data = $data;
        }
        
        $this->error = $error;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getError()
    {
        return $this->error;
    }

    public function createAnimal()
    {
        return new Animal($this->data[self::NAME_REF],$this->data[self::SPECIES_REF],intval($this->data[self::AGE_REF]));
    }

    private function isDataValid()
    {
        return $this->data[self::NAME_REF] !== '' && $this->data[self::SPECIES_REF] !== '' && $this->data[self::AGE_REF] !== '' && intval($this->data[self::AGE_REF]) >= 0;
    }

    public function isValid()
    {   
        if(!$this->isDataValid())
        {
            $inputNames = array(self::NAME_REF, self::SPECIES_REF, self::AGE_REF);
            $fieldNames = array('Nom', 'Espèce', 'Age');
            $this->error = '<h3>Erreur</h3><div class="error-explaination">';
            foreach($inputNames as $key => $value)
            {
                $this->error .= $this->data[$value] === '' ? '<p>Le champs: ' . $fieldNames[$key] . ' est vide.' : '';                
            }
            $this->error .= intval($this->data['age']) < 0 ? '<p>Le champs: Age a une valeur plus petite que 0.' : '';
            $this->error .= '</div>';
            return false;
        }
        return true;
    }
}