<?php

namespace Course\Controllers;

class Controller
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function view($view, $data = [])
    {
        $view = str_replace('.', '/', $view);
        $view = rtrim($view, '.php');
        require_once __DIR__ . '/../../resources/views/' . $view . '.php';
    }

    public function withRedirect(string $url)
    {
        header('location:' . $url);
    }

    public function __get($property)
    {
        if (isset($this->container->{$property})) {
            return $this->container->{$property};
        }
    }
}
