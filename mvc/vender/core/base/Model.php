<?php
/**
 * Created by PhpStorm.
 * User: Vgant
 * Date: 10.02.2017
 * Time: 21:34
 */

namespace vender\core\base;
use vender\core\DB;

class Model
{
    protected $_mysql;
    protected $_table;

    public function __construct()
    {
        $this->_mysql = DB::instanse();

    }

    public function qery()
    {
        return $this->_mysql-Select("*",$this->_table);
    }
}