<?php

namespace Mali\Http;

use Mali\View\View;

class Route
{
    // This array will contain (routes) (corresponding to) => (actions)
    public static array $routes = [];
    
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static function get($route, $action) // action => callable|array
    {
        self::$routes['get'][$route] = $action;
    }

    public static function post($route, $action)
    {
        self::$routes['post'][$route] = $action;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $action = self::$routes[$method][$path] ?? false;

        if(!array_key_exists($path, self::$routes[$method]))
        {
            $this->response->setStatusCode(404);
            View::makeError('404');
        }

        if(!$action)
        {
            return;
        }

        if(is_callable($action))
        {
            call_user_func_array($action, $this->hasParams($action) ? $_GET : []);
        }

        if(is_array($action))
        {
            call_user_func_array([new $action[0], $action[1]], $this->hasParams($action) ? $_GET : []);
        }
    }

    private function hasParams($function) : bool
    {
        if(is_array($function)) {
            $reflection = new ReflectionMethod($function[0], $function[1]);
        }
        else {
            $reflection = new ReflectionFunction($function);
        }

        return $reflection->getNumberOfParameters() > 0;
    }
}
