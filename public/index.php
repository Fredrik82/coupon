<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;

$container = (new ContainerBuilder())->build();
$app = Bridge::create($container);
$app->addRoutingMiddleware();

$app->run();