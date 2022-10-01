<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Service;

use Fredrik82\Coupon\Model\Account\BrandManager;
use Fredrik82\Coupon\Model\Account\Customer;
use Fredrik82\Coupon\Model\Discount\CouponCode;

class DocumentStorageAdapter
{
    public function createCoupons(array $couponCodes, BrandManager $brandManager): void
    {
        // Todo
    }

    public function saveCustomerData(CouponCode $couponCode, Customer $customer): void
    {
        // Todo
    }
}