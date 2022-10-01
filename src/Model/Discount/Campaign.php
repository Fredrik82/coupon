<?php

declare(strict_types=1);

namespace Fredrik82\Coupon\Model\Discount;

use DateTime;
use DateTimeInterface;

class Campaign implements \JsonSerializable
{
    public function __construct(
        protected string $campaignName,
        protected DateTime $expireDate
    ) {
    }

    public function getCampaignName(): string
    {
        return $this->campaignName;
    }

    public function getExpireDate(): DateTime
    {
        return $this->expireDate;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'campaignName' => $this->campaignName,
            'expireDate' => $this->expireDate->format(DateTimeInterface::ATOM)
        ];
    }
}