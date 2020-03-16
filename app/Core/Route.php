<?php

namespace Course\Core;

trait Route {

    protected $routes = ['get' => [], 'post' => [], 'put' => [], 'delete' => []];

    public function get(string $route, $action) {
        $this->routes['get'][] = ['url' => $route, 'action' => $action];
        return $this;
    }

    public function post(string $route, $action) {
        $this->routes['post'][] = ['url' => $route, 'action' => $action];
        return $this;
    }

    public function put(string $route, $action) {
        $this->routes['put'][] = ['url' => $route, 'action' => $action];
        return $this;
    }

    public function delete(string $route, $action) {
        $this->routes['delete'][] = ['url' => $route, 'action' => $action];
        return $this;
    }
}
