<?php

namespace Course\Core;

use Course\Core\Contracts\ContainerInterface;

class App
{
    use RouteContainer;

    protected $container;
    protected $request;
    protected $response;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->request = new Request($container);
        $this->response = new Response();
        $this->sel = -1;
    }

    public function run()
    {
        $this->request->setRoutes($this->routes);
        if ($this->request->getRoute()) {
            $this->response->next($this->request, $this->response);
        } else {
            echo '<h1>Not Found</h1>';
        }
    }
}
