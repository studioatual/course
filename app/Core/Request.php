<?php

namespace Course\Core;

class Request
{
    protected $routes;

    public function getRoute()
    {
        $route = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        $route = rtrim($route, '/');
        return filter_var($route, FILTER_SANITIZE_URL);
    }

    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function getArgs()
    {
        parse_str($_SERVER['QUERY_STRING'], $args);
        return $args;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getParams()
    {
        $parts = array_filter(explode('/', $this->getRoute()));
        $total = count($parts);
        $routes = $this->getRoutesLength($total);
        $list = [];
        foreach ($routes as $route) {
            $r_parts = explode('/', $this->getRoute());
            $check = true;

            for ($i=0; $i < $total; $i++) {
                if ($parts[$i] != $r_parts[$i] && !$this->isParam($r_parts[$i])) {
                    $check = false;
                }
            }

            if ($check) {
                $list[] = $route;
            }
        }
    }

    private function isParam($slug)
    {
        return strpos($slug, '{') && strrpos($slug, '}');
    }

    private function getRoutesLength($total)
    {
        return array_filter($this->routes[$this->getMethod()], function ($route) use ($total) {
            return $total == count(array_filter(explode('/', $route['url'])));
        });
    }
}
