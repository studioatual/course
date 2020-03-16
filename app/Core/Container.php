<?php

namespace Course\Core;

class Container
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