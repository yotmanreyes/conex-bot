<?php
class Database 
{
    private $_db;
    static $_instance;

    private function __construct() {
        $this->_db = new PDO('mysql:host=66.113.164.200;dbname=demoscs4_liceos_v2', 'demoscs4_admin1', 'D8m~@#L;BO#v');
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function __clone(){}

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function query($sql) {
        return $this->_db->query($sql);
    }

}