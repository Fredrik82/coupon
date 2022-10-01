<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Middleware;

use DI\Container;
use Fredrik82\Coupon\Model\Account\BrandManager;
use Fredrik82\Coupon\Model\Account\Customer;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequireAuthenticatedUser
{
    protected Container $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function __invoke(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler,
    ): ResponseInterface {

        if (!$this->isAuthenticated()) {
            return (new Response())->withStatus(401, 'Unauthorized');
        }

        return $handler->handle($request);
    }

    protected function isAuthenticated(): bool
    {
        $this->container->set(
            BrandManager::class,
            new BrandManager(123, 'Jon Smith', 'jon.smith@brandcompany.com')
        );
        $this->container->set(
            Customer::class,
            new Customer(123, 'Fred', 'fred@happyconsumer.com', '0704732590')
        );
        return true;
    }
}
