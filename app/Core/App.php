<?php

namespace Course\Core;

use Course\Core\Contracts\ContainerInterface;

class App
{
    use RouteContainer;

    protected $container;
    protected $request;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->request = new Request();
    }

    public function run()
    {
        $this->request->setRoutes($this->routes);
        $route = $this->request->getRoute();
        if ($route) {
            if (is_callable($route->getAction())) {
                return $route->getAction()($this->request);
            }
            $p_controller = $route->getAction()['controller'];
            $p_method = $route->getAction()['method'];
            $controller = new $p_controller($this->container);
            return $controller->{$p_method}($this->request);
        } else {
            echo '<h1>Not Found</h1>';
        }
    }
}
