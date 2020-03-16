<?php

namespace Course\Core;

use Exception;

class App
{
    use Route, Request;

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run()
    {
        return array_filter($this->routes[$this->getMethod()], function ($value) {
            if (($value['url'] == '[/]' && $this->getRoute() == '') || $value['url'] == $this->getRoute()) {
                if (is_string($value['action'])) {
                    $params = explode(':', $value['action']);
                    $action = str_replace('.', '\\', $params[0]);
                    $action = 'Course\\Controllers\\' . $action;
                    $controller = new $action($this->container);
                    $method = $params[1];
                    return $controller->{$method}();
                }
                return $value['action']();
            }
        });
    }
}
