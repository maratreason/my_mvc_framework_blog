<?php

namespace Application\Core;

use Application\Core\View;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require 'application/config/routes.php';
        foreach($arr as $key => $value) {
            $this->add($key, $value);
        }
    }

    /**
     * Функция добавления роута в массив роутов.
     *
     * @param [type] $route - маршрут
     * @param [type] $params - параметры
     * @return void
     */
    public function add($route, $params)
    {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    /**
     * Функция проверяет есть ли такой маршрут.
     *
     * @return true/false.
     */
    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            // Проверяем соответствие регулярки
            // $matches - совпадения, которые найдены
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->match()) {
            $path = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'] . 'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}