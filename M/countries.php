<?php

class Countries
{
    private $_id;
    private $_countries;

    public function __construct($arr = [])
    {
        if (!empty($arr)) {
            foreach ($arr as $key => $value) {
                if ($key == 'id') {
                    $this->setId($value);
                }
                if ($key == 'countries') {
                    $this->setCountries($value);
                }
            }
        }

    }

    public function getCountries()
    {
        return $this->_countries;
    }

    public function setCountries($countries)
    {
        $this->_countries = $countries;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

}