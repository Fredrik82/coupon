<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Model\Account;

use Fredrik82\Coupon\Model\Brand\Company;

class BrandManager extends AccountAbstract
{
    public function __construct(
        protected int $id,
        protected string $name,
        protected string $email
    ) {
        parent::__construct($id, $name, $email);
    }
}