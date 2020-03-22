<?php

namespace Course\Core;

use Course\Core\Contracts\ContainerInterface;

class App
{
    use RouteContainer;

    protected $container;
    protected $request;
    protected $response;
    protected $sel;
    protected $route;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->request = new Request();
        $this->sel = 0;
    }

    public function run()
    {
        $this->request->setRoutes($this->routes);
        $this->route = $this->request->getRoute();
        if ($this->route) {
            if (count($this->route->getMiddlewares()) > $this->sel) {
                $middleware = $this->route->getMiddlewares()[$this->sel];
                return $middleware($this->request, function ($request) {
                    $this->sel++;
                    if (count($this->route->getMiddlewares()) > $this->sel) {
                        $middleware = $this->route->getMiddlewares()[$this->sel];
                        return $middleware($request, $this->next);
                    }
                    return $this->render();
                });
            }
            return $this->render();
        } else {
            echo '<h1>Not Found</h1>';
        }
    }

    public function next()
    {
    }

    public function render()
    {
        if (is_callable($this->route->getAction())) {
            return $this->route->getAction()($this->request);
        }

        $p_controller = $this->route->getAction()['controller'];
        $p_method = $this->route->getAction()['method'];
        $controller = new $p_controller($this->container);
        return $controller->{$p_method}($this->request);
    }
}
