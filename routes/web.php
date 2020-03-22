<?php

use Course\Core\Contracts\RequestInterface;
use Course\Middlewares\TestMiddleware;

$app->get('/customers', 'CustomerController:index')
    ->setName('customers.index')->add(new TestMiddleware($container));
$app->get('/customers/create', 'CustomerController:create')->setName('customers.create');
$app->post('/customers', 'CustomerController:store');
$app->get('/customers/{id}', 'CustomerController:show')->setName('customers.show');
$app->put('/customers/{id}', 'CustomerController:update');
$app->delete('/customers/{id}', 'CustomerController:destroy');

$app->get('[/]', 'HomeController:index')->setName('home');
