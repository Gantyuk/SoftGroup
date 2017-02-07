<?php
class Studio
{
    private $_id;
    private $_Name_studio;
    private $_id_Address;
    private $_Contact;

    public function __construct($arr = [])
    {
        if (!empty($arr)) {
            foreach ($arr as $key => $value) {
                if ($key == 'id') {
                    $this->setId($value);
                }
                if ($key == 'Name_studio') {
                    $this->setNameStudio($value);
                }
                if ($key == 'id_Address') {
                    $this->setIdAddress($value);
                }
                if ($key == 'Contact') {
                    $this->setContact($value);
                }
            }
        }
    }

    public function Add_to_DB($mysqli)
    {
        $mysqli->query("
					INSERT INTO
						studio (Name_studio, id_Address, Contact)
					VALUES
						('" . $this->_Name_studio . "'," . $mysqli->insert_id . ",'" . $this->_Contact . "')
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

}
?>