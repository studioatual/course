<?php

namespace Course\Core;

class Response
{
    public function next($request, $response)
    {
        $route = $request->getRoute();
        $middlewares = $route->getMiddlewares();

        if (count($middlewares) > $request->getSel()) {
            $middleware = $route->getMiddlewares()[$request->getSel()];
            $request->setSel($request->getSel() + 1);
            $middleware($request, $response, call_user_func($this->next, $request));
        } else {
            return $this->render($request);
        }
    }

    public function render($request)
    {
        $route = $request->getRoute();
        $container = $request->getContainer();

        if (is_callable($route->getAction())) {
            return $route->getAction()($request);
        }

        $p_controller = $route->getAction()['controller'];
        $p_method = $route->getAction()['method'];
        $controller = new $p_controller($container);
        return $controller->{$p_method}($request);
    }
}
