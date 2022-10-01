<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Fredrik82\Coupon\Middleware\RequireAuthenticatedUser;
use Fredrik82\Coupon\Service\CouponApi;
use Slim\Routing\RouteCollectorProxy;

$container = (new ContainerBuilder())->build();
$app = Bridge::create($container);
$app->addRoutingMiddleware();

$app->group('', function (RouteCollectorProxy $proxy) {
    $proxy->get('/topic/{name}', [CouponApi::class, 'fetchCoupon']);
    $proxy->post('/topic/{name}/{numberOfCoupons:\d+}', [CouponApi::class, 'createCoupons']);
})->add(RequireAuthenticatedUser::class);

$app->run();