<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Model\Discount;

use DateTime;
use Doctrine\Instantiator\Instantiator;
use Fredrik82\Coupon\Model\Account\BrandManager;

class CouponCode extends Campaign
{
    protected string $uniqueCode;

    public function __construct(
        protected string $campaignName,
        protected DateTime $expireDate,
    ) {
        parent::__construct($this->campaignName, $this->expireDate);
        // Chance of collision is 16**10 = 1,099,511,627,776
        $this->uniqueCode = mb_strtoupper(substr(sha1(random_bytes(32)), 0, 10));
    }

    public function getCode(): string
    {
        return $this->uniqueCode;
    }

    public function isExpired(): bool
    {
        return $this->expireDate < new DateTime('now');
    }

    public static function fromArray(array $data): static {
        $couponCode = (new Instantiator())->instantiate(__CLASS__);
        foreach ($data as $property => $value) {
            $property = ucfirst($property);
            if ($value !== null && method_exists($couponCode, 'set' . $property)) {
                $couponCode->{"set$property"}($value);
            }
        }
        $couponCode->uniqueCode = $data['uniqueCode'];

        return $couponCode;
    }

    public function jsonSerialize(): mixed
    {
        $array = parent::jsonSerialize();
        $array['uniqueCode'] = $this->uniqueCode;

        return $array;
    }
}