<?php

class DB extends PDO {
   
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
    private $charSet;
    
    
   
    public function __construct(){
        $this->engine = 'mysql';
        $this->host = '192.168.100.101:3306';
        $this->database = 'arStore';
        $this->user = 'newUser';
        $this->charSet=';charset=utf8';
        $this->pass = '@19071907@';
        $dns = $this->engine.':dbname='.$this->database.$this->charSet.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass );
    }


} 


class Caller {
    
    protected static $_instance = array();
    
    private static function control($v){
        return class_exists($v);
    }
    
    private static function getObject($item, $args){
        if(is_object($item)) return $item;
        else return (self::control($item) ? new $item($args) : false);
    }
    
    public static function getName($obj){
        return get_class($obj);
    }
    
    public static function add($obj, $name = '', $args = array()){
        
        if(false === ($obj = self::getObject($obj, $args))) return false;
        
        $n = ($name !== '' ? $name : self::getName($obj));
        if(isset(self::$_instance[$n])) return false;
        
        if(!isset(self::$_instance[$n])){
            self::$_instance[$n] = $obj;
        }
        
        return true;
    }
    
    public static function get($n){
        return (isset(self::$_instance[$n]) ? self::$_instance[$n] : false);
    }


    
    protected function __clone(){}    
}


?>