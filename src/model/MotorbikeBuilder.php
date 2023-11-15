<?php
class MotorbikeBuilder
{
    private $data, $error;
    public const BRAND_REF = 'brandname';
    public const MODEL_REF = 'model';
    public const COLOR_REF = 'color';
    public const CCS_REF = 'ccs';
    public const MANU_YEAR_REF = 'manufactureYear';

    public function __construct($data=null, $error=null)
    {
        if($data === null)
        {
            $this->data = array(self::BRAND_REF=>'', self::MODEL_REF=>'', self::COLOR_REF=>'', self::CCS_REF=>'', self::MANU_YEAR_REF=>'');
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

    public function createMotorbike()
    {
        return new Motorbike($this->data[self::BRAND_REF],$this->data[self::MODEL_REF],$this->data[self::COLOR_REF], intval($this->data[self::CCS_REF]), intval($this->data[self::MANU_YEAR_REF]));
    }

    private function isDataValid()
    {
        return $this->data[self::BRAND_REF] !== '' && $this->data[self::MODEL_REF] !== '' && $this->data[self::COLOR_REF] !== '' && $this->data[self::MANU_YEAR_REF] !== '' && intval($this->data[self::MANU_YEAR_REF]) >= 0 && intval($this->data[self::CCS_REF]) >= 1;
    }

    public function isValid()
    {   
        if(!$this->isDataValid())
        {
            $inputNames = array(self::BRAND_REF, self::MODEL_REF, self::COLOR_REF, self::CCS_REF, self::MANU_YEAR_REF);
            $fieldNames = array('Brand', 'Model', 'Color', 'Engine size', 'Manufacture year');
            $this->error = '<h3>Error</h3><div class="error-explaination">';
            foreach($inputNames as $key => $value)
            {
                $this->error .= $this->data[$value] === '' ? '<p>Field: ' . $fieldNames[$key] . ' is empty.' : '';                
            }
            $this->error .= intval($this->data[self::CCS_REF]) < 1 ? '<p>Field: Engine size must be greater than or equal to 1.' : '';
            $this->error .= intval($this->data[self::MANU_YEAR_REF]) < 0 ? '<p>Field: Manufacture year must be greater than or equal to 0.' : '';
            $this->error .= '</div>';
            return false;
        }
        return true;
    }
}