<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Service;

use Fredrik82\Coupon\Model\Discount\Campaign;
use Fredrik82\Coupon\Model\Discount\CouponCode;

/** TODO: make this a background worker */
class CouponGenerator
{
    public static function generateCoupons(Campaign $campaign, int $amount): array
    {
        $uniqueCodes = [];
        do {
            $coupon = new CouponCode(
                $campaign->getCampaignName(),
                $campaign->getExpireDate()
            );
            $uniqueCodes[$coupon->getCode()] = $coupon;
        } while (count($uniqueCodes) < $amount);

        return $uniqueCodes;
    }
}