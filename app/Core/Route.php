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

    public function getMethod()
    {
        return $this->method;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function getAction()
    {
        if (is_callable($this->action)) {
            return $this->action;
        }

        $params = explode(':', $this->action);

        return [
            'controller' => 'Course\\Controllers\\' . str_replace('.', '\\', $params[0]),
            'method' => $params[1]
        ];
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function add($middlewares)
    {
        $this->middlewares[] = $middlewares;
        return $this;
    }
}
