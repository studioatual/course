<?php

namespace Course\Core;

class Request
{
    protected $routes;

    public function getURL()
    {
        $route = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        $route = rtrim($route, '/');
        return filter_var($route, FILTER_SANITIZE_URL);
    }

    public function getArgs()
    {
        parse_str($_SERVER['QUERY_STRING'], $args);
        return $args;
    }

    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function getRoute()
    {
        $list = array_filter(explode('/', $this->getURL()));
        $routes = $this->routes[$this->getMethod()];
        for ($i = 0; $i < count($list); $i++) {
            $routes = $this->filterRoutes(count($list), $i, $list[$i], $routes);
        }
        var_dump($routes);
    }

    private function filterRoutes($total, $i, $val, $routes)
    {
        return array_filter($routes, function ($route) use ($total, $i, $val) {
            $list = array_filter(explode('/', $route['url']));
            if ($list[$i] == $val && $total == count($list)) {
                return $route;
            }
            if (strpos($list[$i], '{') !== false && strrpos($list[$i], '}') !== false && $total == count($list)) {
                return $route;
            }
        });
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

            for ($i = 0; $i < $total; $i++) {
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
