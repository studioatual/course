<?php

use Course\Database\Connection;

$container->set('db', function ($c) {
    $conn = new Connection($c->get('settings')['db']);
    return $conn->getConnection();
});
