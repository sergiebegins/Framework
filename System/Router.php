<?php
class Router
{
    public function index(...$params){

        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/Home', 'Home_index');
            $r->addRoute('GET', '/Settings/{id:\d+}[/{title:\d+}]', 'Settings_index');
        });

        $httpMethod = $params[0];
        $uri = $params[1];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                $class = explode("_",$handler);

                break;
        }

        if(empty($class)){ $class = explode('_','Home_index');}
        if(empty($vars)){ $vars = array();}

        return array($class,$vars);
    }

}
