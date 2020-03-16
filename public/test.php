<?php

function filterRoutes($total, $i, $val, $routes)
{
    return array_filter($routes, function ($r) use ($total, $i, $val) {
        $list = array_filter(explode('/', $r));
        if (count($list) == $total && $r != '[/]') {
            if ($list[$i] == $val && $total == count($list)) {
                return $r;
            }
            if (strpos('{', $list[$i]) !== false && strrpos('}', $list[$i]) !== false && $total == count($list)) {
                return $r;
            }
        }
    });
}

$url = '/customer/1';
$list = array_filter(explode('/', $url));
$routes = ['/customers', '/customers/{id}', '[/]'];
//var_dump($routes);
for ($i = 0; $i < count($list); $i++) {
    $routes = filterRoutes(count($list), $i, $list[$i], $routes);
    var_dump($routes);
}
