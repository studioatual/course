<?php

namespace Course\Core;

use Course\Core\Contracts\ContainerInterface;

class Container implements ContainerInterface
{
    public function get($property)
    {
        if (isset($this->{$property})) {
            return $this->{$property};
        }
        return null;
    }

    public function set($property, $value)
    {
        $this->{$property} = $value;
        return $this;
    }
}
