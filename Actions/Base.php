<?php
include('../public/vendor/smarty/smarty/libs/Smarty.class.php');
class Base
{
    protected $smarty;
    protected $mongo;
    protected $redis;

    public function __construct()
    {

            $this->smarty = new Smarty;
            $this->smarty->setCaching(0);
            $this->mongo = (new \MongoDB\Client)->arStore;
            $this->redis = new Predis\Client();
    }

}