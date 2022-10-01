<?php

declare(strict_types=1);

use Fredrik82\Coupon\Model\Discount\Campaign;
use Fredrik82\Coupon\Service\CouponGenerator;
use PHPUnit\Framework\TestCase;

class CouponGeneratorTest extends TestCase
{
    public function testGenerate(): void
    {
        $campaign = $this->createMock(Campaign::class);
        $campaign
            ->method('getExpireDate')
            ->willReturn(new DateTime('20221001'));
        $campaign
            ->method('getCampaignName')
            ->willReturn('Happy hour');

        $numberOfCoupons = 100000;
        $coupons = CouponGenerator::generateCoupons($campaign, $numberOfCoupons);

        self::assertCount($numberOfCoupons, $coupons, 'Wrong number of coupons generated!');
    }
}