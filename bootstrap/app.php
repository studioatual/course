<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Course\Core\App;
use Course\Core\Container;

$container = new Container();
$app = new App($container);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/database.php';

require_once __DIR__ . '/../routes/web.php';
