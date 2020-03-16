<?php

namespace Course\Core;

trait Request
{
    private function getRoute()
    {
        $route = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        $route = rtrim($route, '/');
        return filter_var($route, FILTER_SANITIZE_URL);
    }

    private function getArgs()
    {
        parse_str($_SERVER['QUERY_STRING'], $args);
        return $args;
    }

    private function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
