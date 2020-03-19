<?php

namespace Course\Core;

class Route
{
    protected $method;
    protected $url;
    protected $action;
    protected $name;
    protected $middlewares;

    public function __construct(string $method, string $url, $action)
    {
        $this->method = $method;
        $this->url = $url;
        $this->action = $action;
        $this->middlewares = [];
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function add($middlewares)
    {
        $this->middlewares[] = $middlewares;
        return $this;
    }
}
