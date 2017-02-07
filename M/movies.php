<?php
require_once ("conect_db.php");
class Movies
{
    protected $_id;
    protected $_id_directors;
    protected $_Name;
    protected $_id_genres;
    protected $_Duration;
    protected $_year;
    protected $_Biudjet;
    protected $_id_Studio;
    protected $_Date;

    public function __construct($arr = [])
    {
        if (!empty($arr)) {
            foreach ($arr as $key => $value) {
                if ($key == 'id') {
                    $this->setId($value);
                }
                if ($key == 'Name') {
                    $this->setName($value);
                }
                if ($key == 'id_directors') {
                    $this->setIdDirectors($value);
                }
                if ($key == 'id_genres') {
                    $this->setIdGenres($value);
                }
                if ($key == 'year') {
                    $this->setYear($value);
                }
                if ($key == 'Duration') {
                    $this->setDuration($value);
                }
                if ($key == 'Biudjet') {
                    $this->setBiudjet($value);
                }
                if ($key == 'id_Studio') {
                    $this->setIdStudio($value);
                }
                if ($key == 'Date') {
                    $this->setDate($value);
                }
            }
        }
    }

    public function getBiudjet()
    {
        return $this->_Biudjet;
    }

    public function setBiudjet($Biudjet)
    {
        $this->_Biudjet = $Biudjet;
    }

    public function getDate()
    {
        return $this->_Date;
    }

    public function setDate($Date)
    {
        $this->_Date = $Date;
    }

    public function getDuration()
    {
        return $this->_Duration;
    }

    public function setDuration($Duration)
    {
        $this->_Duration = $Duration;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getIdDirectors()
    {
        return $this->_id_directors;
    }

    public function setIdDirectors($id_directors)
    {
        $this->_id_directors = $id_directors;
    }

    public function getIdGenres()
    {
        return $this->_id_genres;
    }

    public function setIdGenres($id_genres)
    {
        $this->_id_genres = $id_genres;
    }

    public function getIdStudio()
    {
        return $this->_id_Studio;
    }

    public function setIdStudio($id_Studio)
    {
        $this->_id_Studio = $id_Studio;
    }

    public function getName()
    {
        return $this->_Name;
    }

    public function setName($Name)
    {
        $this->_Name = $Name;
    }

    public function getYear()
    {
        return $this->_year;
    }

    public function setYear($year)
    {
        $this->_year = $year;
    }

    public function Add($mysqli)
    {
        $mysqli->query( "
			INSERT INTO
				movies (id_directors, Name, id_genres, Duration, year, Biudjet, id_Studio, Date)
			VALUES
				(" . $this->getIdDirectors() . ", '" . $this->getName() . "', " . $this->getIdGenres() . ", " . $this->getDuration() . ",
				" . $this->getYear() . ", " . $this->getBiudjet() . ", " . $this->getIdStudio() . ", " . $this->getDate() . ")"	);
    }
}
?>