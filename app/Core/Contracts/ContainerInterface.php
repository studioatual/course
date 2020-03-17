<?php

namespace Course\Core\Contracts;

interface ContainerInterface
{
    public function get(string $property);
    public function set(string $property, $value);
}
