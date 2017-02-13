<?php
namespace app\models;
use vender\core\DB;

class Studio extends DB
{
    private $_id;
    private $_Name_studio;
    private $_id_Address;
    private $_Contact;

    public function __construct()
    {
        $this->_mysql = DB::instanse();
    }

    public function Add()
    {
        $this->_mysql->Query("
					INSERT INTO
						studio (Name_studio, id_Address, Contact)
					VALUES
						('" . $this->getNameStudio() . "'," . $this->getIdAddress() . ",'" . $this->getContact() . "')
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

    public function getContact()
    {
        return $this->_Contact;
    }

    public function setContact($Contact)
    {
        $this->_Contact = $Contact;
    }

    public function getIdAddress()
    {
        return $this->_id_Address;
    }

    public function setIdAddress($id_Address)
    {
        $this->_id_Address = $id_Address;
    }

    public function getNameStudio()
    {
        return $this->_Name_studio;
    }

    public function setNameStudio($Name_studio)
    {
        $this->_Name_studio = $Name_studio;
    }
    
    public function Display_Studio()
    {
        $result =  $this->_mysql->Query("SELECT s.id, s.Name_studio, c.countries AS c_countries, t.town AS t_town, a.street AS a_street, a._index AS a_index, s.Contact     
					FROM studio s
					JOIN address a ON s.id_Address = a.id
                    JOIN countries c ON a.id_countries = c.id
                    JOIN town t ON a.id_town = t.id "
        );
        $studio = array();
        while( $row = $result->fetch_assoc() ){
            $studio[] = $row;
        }
        return $studio;
    }

}
?>