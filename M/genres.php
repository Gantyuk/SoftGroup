<?php
class Genres
{
    private $_id;
    private $_genres;

    public function __construct($arr = [])
    {
        if (!empty($arr)) {
            foreach ($arr as $key => $value) {
                if ($key == 'id') {
                    $this->setId($value);
                }
                if ($key == 'genres') {
                    $this->setGenres($value);
                }
            }
        }

    }

    public function getGenres()
    {
        return $this->_genres;
    }

    public function setGenres($genres)
    {
        $this->_genres = $genres;
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