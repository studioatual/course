<?php

namespace Course\Middlewares;

class TestMiddleware extends Middleware
{
    public function __invoke($request)
    {
        echo 'Test';
        die();
    }
}
