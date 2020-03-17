<?php

namespace Course\Core;

use Exception;

class App
{
    use Route;

    protected $container;
    protected $request;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->request = new Request();
    }

    public function run()
    {
        $this->request->setRoutes($this->routes);
        $route = $this->request->getRoute();
        if ($route) {
            if (is_string($route['action'])) {
                $params = explode(':', $route['action']);
                $action = str_replace('.', '\\', $params[0]);
                $action = 'Course\\Controllers\\' . $action;
                $controller = new $action($this->container);
                $method = $params[1];
                return $controller->{$method}($this->request);
            }

            return $route['action']($this->request);
        } else {
            echo '<h1>Not Found</h1>';
        }
    }
}
