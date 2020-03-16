<?php

$container->set('db', function ($c) {
    $tns = "(DESCRIPTION=
        (ADDRESS_LIST=
            (ADDRESS=
                (PROTOCOL=TCP)
                (HOST=$c->get('settings')['db']['host'])
                (PORT=$c->get('settings')['db']['port'])
            )
        )
        (CONNECT_DATA=
            (SERVER=DEDICATED)
            (SERVICE_NAME=$c->get('settings')['db']['database'])
        )
    )";
    $user = $c->get('settings')['db']['username'];
    $pass = $c->get('settings')['db']['password'];
    $charset = $c->get('settings')['db']['charset'];
    $pdo = new PDO('oci:dbname=' . $tns . ';charset=' . $charset, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
});