<?php
namespace FirstProject\Router;

class Router {
    private static $routes = Array();

    public static function add($url, $view, $method = 'get') {
        array_push(self::$routes,Array('url' => $url,
                                        'view' => $view,
                                        'method' => $method));
    }

    public static function run(){
        $method = $_SERVER['REQUEST_METHOD'];
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);
        if (isset($parsed_url['path'])){
          $path = $parsed_url['path'];
        } else {
          $path = '/';
        }
        $basepath = "/first_project/";
        foreach (self::$routes as $route) {
            if (strtolower($method) == strtolower($route['method'])) {    
                switch ($path) {
                    case $basepath . '':
                    case $basepath . '/':
                        require 'FirstProject/Views/index.php';
                        break;
                    case $basepath . '/' . $route['url']:
                        require 'FirstProject/Views/' . $route['view'] . '.php';
                        break;
                    default:
                        http_response_code(404);
                        require 'FirstProject/Views/404.php';
                        break;
                }
            }
        }
    }
}