<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Model\Brand;

use Fredrik82\Coupon\Model\Account\BrandManager;
use Fredrik82\Coupon\Model\Discount\Campaign;

class Company implements \JsonSerializable
{

    public function __construct(
        protected int $organisationNumber,
        protected string $name,
        protected array $brandManagers = [],
        protected array $campaigns = []
    ) {
    }

    /** @return BrandManager[] */
    public function getBrandManagers(): array
    {
        return $this->brandManagers;
    }

    /** @return Campaign[] */
    public function getCampaigns(): array
    {
        return $this->campaigns;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'organisationNumber' => $this->organisationNumber,
            'name' => $this->name,
            'brandManagers' => $this->brandManagers,
            'campaigns' => $this->campaigns
        ];
    }
}