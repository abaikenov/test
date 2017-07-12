<?php
namespace core;

class Application
{
    public $defaultController = 'site';
    public $defaultAction = 'index';

    public function handleRequest()
    {
        $controller = $this->defaultController;
        $action = $this->defaultAction;

        $url = explode('?', $_SERVER['REQUEST_URI']);
        $url = explode('/', ltrim($url[0], '/'));

        if (!empty($url[0])) {
            $controller = strtolower($url[0]);
        }
        if (!empty($url[1])) {
            $action = strtolower($url[1]);
        }

        $controllerID = $controller;
        $controller = $controller . 'Controller';
        $action = 'action' . lcfirst($action);
        $controllerPath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . $controller . '.php';

        if (file_exists($controllerPath)) {
            include $controllerPath;
        } else {
            throw new \Exception('Controller not found');
        }

        new Connection();
        $controller = 'controllers\\' . $controller;
        $controller = new $controller($controllerID);
        if (method_exists($controller, $action)) {
            call_user_func(array($controller, $action));
        } else {
        }
    }
}