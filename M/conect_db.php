<?php
class Conect_db
{
    protected $_mysqli;

    public function __construct()
    {
        $this->_mysqli = new mysqli("localhost", "root", "", "vidioteka") or die("Помилка: Не можливо підключитися до ДБ( sgdevlab_ph12cn) !!!");
        $this->_mysqli->query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
        $this->_mysqli->query("SET CHARACTER SET 'utf8'");
    }

    public function getMysqli()
    {
        return $this->_mysqli;
    }

    public function Display_Directors()
    {
        $result =  $this->_mysqli->query("SELECT d.id, d.S_Name, d.L_Name, d.Y_Birth, d.Y_Death, c.countries AS c_countries      
					FROM directors d
					JOIN countries c ON d.id_contries = c.id"
        );
        $directors = array();
        while( $row = $result->fetch_assoc() ){
            $directors[] = $row;
        }
        return $directors;
    }

    public function Display_Studio()
    {
        $result =  $this->_mysqli->query("SELECT s.id, s.Name_studio, c.countries AS c_countries, t.town AS t_town, a.street AS a_street, a._index AS a_index, s.Contact     
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

    public function Display_Muvies()
    {
        $result = $this->_mysqli->query("SELECT m.id, m.Name, d.S_Name  AS d_S_name, d.L_Name AS d_L_name , g.genres AS g_genres, m.Duration, m.year, m.Biudjet, s.Name_studio AS s_Name_studio, m.Date       
					FROM movies m
					INNER JOIN directors d  ON m.id_directors = d.id
                    INNER JOIN genres g ON m.id_genres = g.id
                    INNER JOIN studio s ON m.id_Studio = s.id  "
        );
        $movies = array();
        while( $row = $result->fetch_assoc() ){
                $movies[] = $row;
		}
        return $movies;
    }

    public function Display_Muvies_Search($rows, $value)
    {
        $result = $this->_mysqli->query("SELECT m.id, m.Name, d.S_Name  AS d_S_name, d.L_Name AS d_L_name , g.genres AS g_genres, m.Duration, m.year, m.Biudjet, s.Name_studio AS s_Name_studio, m.Date       
					FROM movies m
					INNER JOIN directors d  ON m.id_directors = d.id
                    INNER JOIN genres g ON m.id_genres = g.id
                    INNER JOIN studio s ON m.id_Studio = s.id  
                    WHERE " . $rows ." LIKE '%". $value ."%';"
        );
        $movies = array();
        while( $row = $result->fetch_assoc() ){
            $movies[] = $row;
        }
        return $movies;
    }

    public function Movies_Sort($sort)
    {
        $this->setAddrequest(" ORDER BY " . $sort);
    }

    public function Select($name_row,$name_plates)
    {
        $result =  $this->_mysqli->query("SELECT " . $name_row . " FROM " . $name_plates);
        echo "SELECT " . $name_row . " FROM " . $name_plates ;
        $select = array();
        while( $row = $result->fetch_assoc() ){
            $select[] = $row;
        }
        return $select;
    }

    public function DeletId($id,$name_plates)
    {
        $this->_mysqli->query("	DELETE FROM $name_plates
						WHERE id = $id ;"
        );
    }

    public function Display_Muvies_Where($rows, $value)
    {
        $result = $this->_mysqli->query("SELECT m.id, m.Name, d.S_Name  AS d_S_name, d.L_Name AS d_L_name , g.genres AS g_genres, m.Duration, m.year, m.Biudjet, s.Name_studio AS s_Name_studio, m.Date       
					FROM movies m
					INNER JOIN directors d  ON m.id_directors = d.id
                    INNER JOIN genres g ON m.id_genres = g.id
                    INNER JOIN studio s ON m.id_Studio = s.id  
                    WHERE " . $rows ." = ". $value ." ;"
        );
        $movies = array();
        while( $row = $result->fetch_assoc() ){
            $movies[] = $row;
        }
        return $movies;
    }
}
?>