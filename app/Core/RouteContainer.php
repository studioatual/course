<?php

namespace Course\Core;

trait RouteContainer
{
    protected $routes = [];

    public function get(string $url, $action)
    {
        $route = new Route('GET', $url, $action);
        array_push($this->routes, $route);
        return $route;
    }

    public function post(string $url, $action)
    {
        $route = new Route('POST', $url, $action);
        array_push($this->routes, $route);
        return $route;
    }

    public function put(string $url, $action)
    {
        $route = new Route('PUT', $url, $action);
        array_push($this->routes, $route);
        return $route;
    }

    public function delete(string $url, $action)
    {
        $route = new Route('DELETE', $url, $action);
        array_push($this->routes, $route);
        return $route;
    }
}
