<?php

namespace Course\Core\Contracts;

interface RequestInterface
{
    public function getURL();
    public function getArgs();
    public function getMethod();
    public function setRoutes(array $routes);
    public function getRoute();
    public function getParams();
}
