<?php

namespace Course\Core;

use Course\Core\Contracts\RequestInterface;

class Request implements RequestInterface
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

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function getRoute()
    {
        $url = $this->getURL();

        if (!$url) {
            $route = array_values(array_filter($this->routes[$this->getMethod()], function ($route) {
                if ($route['url'] == '[/]' || $route['url'] == '/') {
                    return $route;
                }
            }));
            return $route[0];
        }

        $list = array_values(array_filter(explode('/', $this->getURL())));
        $routes = $this->routes[$this->getMethod()];

        for ($i = 0; $i < count($list); $i++) {
            if ($routes && count($routes)) {
                $routes = $this->filterRoutesEqual($i, $list, $routes);
                if (!$routes) {
                    $routes = $this->filterRoutesParams($i, $list, $this->routes[$this->getMethod()]);
                }
            }
        }

        if (!$routes) {
            return null;
        }

        return $routes[0];
    }

    private function filterRoutesEqual($i, $list, $routes)
    {
        return array_values(array_filter($routes, function ($route) use ($i, $list) {
            $r_list = array_values(array_filter(explode('/', $route['url'])));
            if (count($r_list) == count($list) && isset($r_list[$i]) && $r_list[$i] == $list[$i]) {
                return $route;
            }
        }));
    }

    private function filterRoutesParams($i, $list, $routes)
    {
        foreach ($routes as $route) {
            $r_list = array_values(array_filter(explode('/', $route['url'])));
            if (count($r_list) == count($list) && isset($r_list[$i]) && strpos($r_list[$i], '{') !== false && strrpos($r_list[$i], '}') !== false) {
                return [$route];
            }
        }
    }

    public function getParams()
    {
        $list = array_values(array_filter(explode('/', $this->getURL())));
        $r_list = array_values(array_filter(explode('/', $this->getRoute()['url'])));
        $params = ($_POST) ? $_POST : [];
        for ($i = 0; $i < count($list); $i++) {

            $init = strpos($r_list[$i], '{');
            $end = strrpos($r_list[$i], '}');

            if ($init !== false &&  $end !== false) {
                $name = substr($r_list[$i], $init + 1, $end - 1);
                $params[$name] = $list[$i];
            }
        }
        return $params;
    }
}
