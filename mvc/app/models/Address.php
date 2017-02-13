<?php
namespace app\models;

use vender\core\DB;
class Address extends DB
{
    private $_id;
    private $_id_countries;
    private $_id_town;
    private $_street;
    private $_index;

    public function __construct($arr = [])
    {
        $this->_mysql = DB::instanse();
    }

    public function Add()
    {
        $this->_mysql->Query("
			INSERT INTO
				address (id_countries, id_town, street, _index)
			VALUES
				(" . $this->getIdCountries() . ", " . $this->getIdTown() . ",'" . $this->getStreet() . "', " . $this->getIndex() . ")
		");
        return $this->_mysql->_mysqli->insert_id;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getIdCountries()
    {
        return $this->_id_countries;
    }

    public function setIdCountries($id_countries)
    {
        $this->_id_countries = $id_countries;
    }

    public function getIdTown()
    {
        return $this->_id_town;
    }

    public function setIdTown($id_town)
    {
        $this->_id_town = $id_town;
    }

    public function getIndex()
    {
        return $this->_index;
    }

    public function setIndex($index)
    {
        $this->_index = $index;
    }

    public function getStreet()
    {
        return $this->_street;
    }

    public function setStreet($street)
    {
        $this->_street = $street;
    }
}
?>