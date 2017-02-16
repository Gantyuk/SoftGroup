<?php

namespace app\models;

use vender\core\DB;

class Main extends DB
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

    protected $_muvi_sql = "SELECT m.id, m.Name, d.S_Name  AS d_S_name, d.L_Name AS d_L_name , g.genres AS g_genres, m.Duration, m.year, m.Biudjet, s.Name_studio AS s_Name_studio, m.Date       
					FROM movies m
					INNER JOIN directors d  ON m.id_directors = d.id
                    INNER JOIN genres g ON m.id_genres = g.id
                    INNER JOIN studio s ON m.id_Studio = s.id  ";


    public function __construct()
    {
        $this->_mysql = DB::instanse();
    }

    public function Display_Muvies()
    {
        $result = $this->_mysql->Query($this->_muvi_sql);
        $movies = array();
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
        return $movies;
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

    public function Add()
    {
        $this->_mysql->Query("
			INSERT INTO
				movies (id_directors, Name, id_genres, Duration, year, Biudjet, id_Studio, Date)
			VALUES
				(" . $this->getIdDirectors() . ", '" . $this->getName() . "', " . $this->getIdGenres() . ", " . $this->getDuration() . ",
				" . $this->getYear() . ", " . $this->getBiudjet() . ", " . $this->getIdStudio() . ", '" . $this->getDate() . "')");
        return $this->getId();
    }

    public function order($by)
    {
        return $this->_mysql->OrderBy($this->_muvi_sql, $by);
    }

    public function Search($table, $value)
    {
        $result = $this->_mysql->Query($this->_muvi_sql . " WHERE " . $table . "=" . $value . ";");
        $movies = array();
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
        return $movies;
    }

    public function SearchLike($table, $value)
    {
        $result = $this->_mysql->Query($this->_muvi_sql . " WHERE " . $table . " LIKE '%" . $value . "%';");
        $movies = array();
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
        return $movies;
    }
}

?>