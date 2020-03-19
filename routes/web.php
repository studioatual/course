<?php

use Course\Core\Contracts\RequestInterface;

$app->get('/customers', 'CustomerController:index')
    ->setName('customers.index')
    ->add(function (RequestInterface $request, $response, $next) {
    });
$app->get('/customers/create', 'CustomerController:create')->setName('customers.create');
$app->post('/customers', 'CustomerController:store');
$app->get('/customers/{id}', 'CustomerController:show')->setName('customers.show');
$app->put('/customers/{id}', 'CustomerController:update');
$app->delete('/customers/{id}', 'CustomerController:destroy');

$app->get('[/]', 'HomeController:index')->setName('home');
