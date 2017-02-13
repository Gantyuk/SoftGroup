<?php
/**
 * Created by PhpStorm.
 * User: Vgant
 * Date: 10.02.2017
 * Time: 21:34
 */

namespace vender\core;


class DB
{
    public $_mysqli;
    protected static $_instanse;

    protected function __construct(){
        $db =require ROOT . '/config_db.php';
        $this->_mysqli = new \mysqli($db['host'], $db['log'], $db['paswd'], $db['table']);
        $this->_mysqli->query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
        $this->_mysqli->query("SET CHARACTER SET 'utf8'");
    }

    public static function instanse()
    {
        if (self::$_instanse === null):
            self::$_instanse = new self;
         endif;

        return self::$_instanse;
    }

    public function Query($sql)
    {
        return $this->_mysqli->query($sql);

    }

    public function DeletId($id,$name_plates)
    {
        $mysql = $this->instanse();
        $mysql->Query("	DELETE FROM $name_plates
						WHERE id = $id ;"
        );
    }

    public function Select($name_row,$name_plates)
    {
        $mysql = $this->instanse();
        $result =  $mysql->Query("SELECT " . $name_row . " FROM " . $name_plates);
        $select = array();
        while( $row = $result->fetch_assoc() ){
            $select[] = $row;
        }
        return $select;
    }
    
    public function OrderBy($sql,$by){
        $mysql = $this->instanse();
        $result = $mysql->Query($sql . " ORDER By " . $by);
        $order = array();
        while( $row = $result->fetch_assoc() ){
            $order[] = $row;
        }
        return $order;
    }
}