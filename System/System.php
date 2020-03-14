<?php
require_once '../public/vendor/autoload.php';
require_once '../public/System/Router.php';
require_once '../public/System/Zescaper.php';
require_once '../public/Actions/Base.php';

class System
{
    public  $httpMethod;
    public  $uri;
    private $routerObject;
    private $escaperObject;


    public function __construct()
    {
        $this->requireHTTPS();
        $this->routerObject = new Router();
        $this->escaperObject = new Zescaper();
    }

    public function Run()
    {


     //   ini_set('display_errors', 1);

      //  ini_set('display_startup_errors', 1);

      //  error_reporting(E_ALL);

        $router =  call_user_func_array(array($this->routerObject, 'index'),array($this->httpMethod,$this->escaperObject->esc($this->uri,'url')));

        $class = $router[0];
        $variables = $router[1];
        if(empty($variables)){$variables="";}
         //$this->escaperObject->esc($router[1]["id"],'url');

        $APPPATH ='./';

        $paths = [
            $APPPATH . 'Actions/',
        ];


        foreach ($paths as $path)
        {
            $fileCheck = false;
            if ($this->requireFile($path . $class[0].".php"))
            {   $fileCheck = true;

                $this->actionsObject = new $class[0]();
                call_user_func_array (array($this->actionsObject, $class[1]),array($variables));
            }

            if($fileCheck == false){
                call_user_func_array (array('Hatali', 'SayfaBulunamadi'),array());
            }

        }

    }

    private function requireFile($file)
    {

        if (is_file($file))
        {
            require_once $file;

            return true;
        }

        return false;
    }

   private function isSecure() {
        return (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || $_SERVER['SERVER_PORT'] == 443
            || (
                (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
                || (!empty($_SERVER['HTTP_X_FORWARDED_SSL'])   && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')
            )
        );
    }

   private function requireHTTPS() {
        if (!$this->isSecure()) {
            header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], TRUE, 301);
            exit;
        }
    }

}




