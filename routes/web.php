<?php

$app->get('/customers', 'CustomerController:index');
$app->get('/customers/create', 'CustomerController:create');
$app->post('/customers', 'CustomerController:store');
$app->get('/customers/{id}', 'CustomerController:show');
$app->put('/customers/{id}', 'CustomerController:update');
$app->delete('/customers/{id}', 'CustomerController:destroy');

$app->get('[/]', 'HomeController:index');
