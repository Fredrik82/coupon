<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Service;

use Fredrik82\Coupon\Model\Account\BrandManager;
use Fredrik82\Coupon\Model\Discount\CouponCode;

class OutboundCouponsQueue
{
    /** Fetches the next available coupon code from the this particular campaign queue */
    public function fetchCouponFromQueue(string $campaignName): CouponCode
    {
        return new CouponCode($campaignName, new \DateTime('+ 1 month'));
    }

    /** Pushes the provided coupon code to this particular campaign queue */
    public function pushCouponToQueue(CouponCode $couponCode, BrandManager $brandManager): void
    {
        // Todo
    }
}