<?php

namespace Microit\StoreBase\Models\DiscountMechanisms;

use Microit\StoreBase\Enums\Currency;
use Microit\StoreBase\Models\DiscountMechanism;

/** @psalm-suppress PropertyNotSetInConstructor */
class BuyXGetY extends DiscountMechanism
{
    public function __construct(float $rawPrice, string $rawUnitText, public readonly int $buyAmount, public readonly int $getAmount, Currency $currency = Currency::EUR)
    {
        $this->amountOfProducts = $this->getAmount;

        parent::__construct($rawPrice, $rawUnitText, $currency);
    }
}
