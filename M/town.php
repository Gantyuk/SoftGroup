<?php
class Town
{
    private $_id;
    private $_town;

    public function __construct($arr = [])
    {
        if (!empty($arr)) {
            foreach ($arr as $key => $value) {
                if ($key == 'id') {
                    $this->setId($value);
                }
                if ($key == 'town') {
                    $this->setTown($value);
                }
            }
        }
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getTown()
    {
        return $this->_town;
    }

    public function setTown($town)
    {
        $this->_town = $town;
    }
}