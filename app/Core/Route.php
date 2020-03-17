<?php

namespace Course\Core;

trait Route {

    protected $routes = ['GET' => [], 'POST' => [], 'PUT' => [], 'DELETE' => []];

    public function get(string $route, $action) {
        $this->routes['GET'][] = ['url' => $route, 'action' => $action];
        return $this;
    }

    public function post(string $route, $action) {
        $this->routes['POST'][] = ['url' => $route, 'action' => $action];
        return $this;
    }

    public function put(string $route, $action) {
        $this->routes['PUT'][] = ['url' => $route, 'action' => $action];
        return $this;
    }

    public function delete(string $route, $action) {
        $this->routes['DELETE'][] = ['url' => $route, 'action' => $action];
        return $this;
    }
}
