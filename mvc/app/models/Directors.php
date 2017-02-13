<?php
namespace app\models;

use vender\core\DB;

class Directors  extends DB
{
    private $_id;
    private $_S_Name;
    private $_L_Name;
    private $_Y_Birth;
    private $_Y_Death;
    private $_id_contries;

    public function __construct()
    {
       $this->_mysql = DB::instanse();
    }

    public function Add()
    {
        $this->_mysql->Query("
			INSERT INTO
				directors (S_Name, L_Name, Y_Birth, Y_Death, id_contries)
			VALUES
				('" . $this->getSName() . "', '" . $this->getLName() . "', " . $this->getYBirth() . ", " . $this->getYDeath() . ", " . $this->getIdContries() . ")
		");
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getIdContries()
    {
        return $this->_id_contries;
    }

    public function setIdContries($id_contries)
    {
        $this->_id_contries = $id_contries;
    }

    public function getLName()
    {
        return $this->_L_Name;
    }

    public function setLName($L_Name)
    {
        $this->_L_Name = $L_Name;
    }

    public function getSName()
    {
        return $this->_S_Name;
    }

    public function setSName($S_Name)
    {
        $this->_S_Name = $S_Name;
    }

    public function getYBirth()
    {
        return $this->_Y_Birth;
    }

    public function setYBirth($Y_Birth)
    {
        $this->_Y_Birth = $Y_Birth;
    }

    public function getYDeath()
    {
        return $this->_Y_Death;
    }

    public function setYDeath($Y_Death)
    {
        $this->_Y_Death = $Y_Death;
    }
    public function Display_Directors()
    {
        $result =  $this->_mysql->Query("SELECT d.id, d.S_Name, d.L_Name, d.Y_Birth, d.Y_Death, c.countries AS c_countries      
					FROM directors d
					JOIN countries c ON d.id_contries = c.id"
        );
        $directors = array();
        while( $row = $result->fetch_assoc() ){
            $directors[] = $row;
        }
        return $directors;
    }

}