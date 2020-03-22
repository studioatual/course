<?php

namespace Course\Middlewares;

use Course\Core\Contracts\RequestInterface;

class TestMiddleware extends Middleware
{
    public function __invoke(RequestInterface $request, $next)
    {
        return $next($request);
    }
}
