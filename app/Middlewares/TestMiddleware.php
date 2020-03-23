<?php

namespace Course\Middlewares;

use Course\Core\Contracts\RequestInterface;

class TestMiddleware extends Middleware
{
    public function __invoke(RequestInterface $request, $response, $next)
    {
        //return $next($request, $response);
    }
}
