<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Model\Account;

class Customer extends AccountAbstract
{
    public function __construct(
        protected int $id,
        protected string $name,
        protected string $email,
        protected string $phoneNumber
    ) {
        parent::__construct($id, $name, $email);
    }

    public function jsonSerialize(): mixed
    {
        $array = parent::jsonSerialize();
        $array['phoneNumber'] = $this->phoneNumber;

        return $array;
    }
}