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
        return array_filter($this->routes[$this->request->getMethod()], function ($value) {
            if (($value['url'] == '[/]' && $this->request->getRoute() == '') || $value['url'] == $this->request->getRoute()) {
                if (is_string($value['action'])) {
                    $params = explode(':', $value['action']);
                    $action = str_replace('.', '\\', $params[0]);
                    $action = 'Course\\Controllers\\' . $action;
                    $controller = new $action($this->container);
                    $method = $params[1];
                    return $controller->{$method}($this->request);
                }
                return $value['action']($this->request);
            }
        });
    }
}
