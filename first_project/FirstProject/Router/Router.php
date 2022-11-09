<?php
namespace FirstProject\Router;
use FirstProject\Router\Controllers;

class Router {
    private static $routes = Array();
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    public function post($url, $action) {
        $this->addAction(self::METHOD_POST, $url, $action);
    }

    public function get($url, $action) {
        $this->addAction(self::METHOD_GET, $url, $action);
    }

    public function addAction($method, $url, $action) {
        array_push(self::$routes, Array('method' => $method, 'url' => $url, 'action' => $action));
    }

    public static function run(){
        $request_method = $_SERVER['REQUEST_METHOD'];
        $request_uri = parse_url($_SERVER['REQUEST_URI']);
        if (isset($request_uri['path'])){
          $request_path = $request_uri['path'];
        } else {
          $request_path = '/';
        }
        $basepath = "/first_project/";

        $action_to_call = null;
        foreach (self::$routes as $route) {
            if (strtolower($request_method) == strtolower($route['method'])) {    
                switch ($request_path) {
                    case $basepath . '':
                    case $basepath . '/':
                        require 'FirstProject/Views/index.php';
                        break;
                    case $basepath . '/' . $route['url']:
                        $action_to_call = $route['action'];
                        var_dump($action_to_call);
                        if(!$action_to_call) {
                            http_response_code(404);
                            require 'FirstProject/Views/404.php';
                            break;
                        }
                        call_user_func_array($action_to_call, [array_merge($_GET, $_POST)]);
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