<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Service;

use DateTime;
use Fredrik82\Coupon\Model\Account\BrandManager;
use Fredrik82\Coupon\Model\Account\Customer;
use Fredrik82\Coupon\Model\Discount\Campaign;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class CouponApi
{

    public function __construct(
        protected DocumentStorageAdapter $documentStorageAdapter,
        protected OutboundCouponsQueue $outboundCouponsQueue,
    ) {
    }

    /**
     * GET /topic/{name}
     */
    public function fetchCoupon(
        ResponseInterface $response,
        Customer $customer,
        string $name,
    ): ResponseInterface {
        $coupon = $this->outboundCouponsQueue->fetchCouponFromQueue($name);

        if ($coupon->isExpired()) {
            $response->withStatus(404);
        }

        $this->documentStorageAdapter->saveCustomerData($coupon, $customer);
        $response
            ->withHeader('Content-Type', 'application/json')
            ->getBody()->write(json_encode($coupon));

        return $response;
    }

    /**
     * POST /topic/{name}/{numberOfCoupons:\d+}
     * body [
     *  string campaign_name,
     *  string expire_date,
     * ]
     */
    public function createCoupons(
        ServerRequestInterface $request,
        ResponseInterface $response,
        BrandManager $brandManager,
        string $name,
        int $numberOfCoupons
    ): ResponseInterface {
        $requestParameters = $request->getParsedBody();

        try {
            $campaign = new Campaign(
                $name,
                new DateTime($requestParameters['expire_date'])
            );
            $coupons = CouponGenerator::generateCoupons($campaign, $numberOfCoupons);
            $this->documentStorageAdapter->createCoupons($coupons, $brandManager);
            foreach ($coupons as $coupon) {
                $this->outboundCouponsQueue->pushCouponToQueue($coupon, $brandManager);
            }
        } catch (Throwable $t) {
            error_log(
                'Error when creating campaign ' . $t->getMessage() . '; '
                . json_encode($requestParameters) . '; Brandmanager: ' . $brandManager->getEmail()
            );
            return $response->withStatus(400);
        }

        return $response->withStatus(201);
    }
}