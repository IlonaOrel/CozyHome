<?php


namespace core;


class Route
{
    static public  function start(){
        $requestURIComponents = self::getURIComponents();

        $controllerName = $requestURIComponents[0] ?? 'index';

        $actionName = $requestURIComponents[1] ?? 'index';

        $controllerClassName = '\controllers\\'.ucfirst($controllerName).'Controller';

        if(!class_exists($controllerClassName)){
           self::error404();
        }

        $controller = new $controllerClassName;
        if(!method_exists($controller, $actionName)){
            self::error404();
        }

        $controller->$actionName();
    }

    static public function getURIComponents(){
        $requestURI = $_SERVER['REQUEST_URI'];

        //URI регитронезависимы
        $requestURI = mb_strtolower($requestURI);
        $requestURIComponents = explode('/', $requestURI);
        array_shift($requestURIComponents);
        if(empty($requestURIComponents[count($requestURIComponents)-1])){
            array_pop($requestURIComponents);

        }
        if(count($requestURIComponents)>2){
            self::error404();
        }
        return $requestURIComponents;
    }

    static  public  function error404(){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }

    static  public  function  redirect($controller = null, $action= null){

        header('Location:'.self::getUrl($controller, $action));
    }

    static public function getUrl($controller = null, $action = null){
        $url = '/';
        if(!empty($controller)) {
            $url .= $controller . '/' . $action;
        }
        return $url;
    }
}