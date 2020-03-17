<?php

namespace Course\Core;

use Course\Core\Contracts\ContainerInterface;

class Container implements ContainerInterface
{
    protected $container;

    public function get($property)
    {
        if (isset($this->container[$property])) {
            return $this->container[$property];
        }
        return null;
    }

    public function set(string $property, $value)
    {
        if (is_callable($value)) {
            $this->container[$property] = $value($this);
            return $this;
        }
        $this->container[$property] = $value;
        return $this;
    }
}
