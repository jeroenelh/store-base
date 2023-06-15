<?php

namespace Microit\StoreBase\Models\DiscountMechanisms;

use Microit\StoreBase\Enums\Currency;
use Microit\StoreBase\Models\DiscountMechanism;

/** @psalm-suppress PropertyNotSetInConstructor */
class PercentageDiscount extends DiscountMechanism
{
    /**
     * @param float $rawPrice Total price without discount
     * @param string $rawUnitText Unit text
     * @param float $percentage Discount percentage
     * @param Currency $currency
     */
    public function __construct(float $rawPrice, string $rawUnitText, protected float $percentage, Currency $currency = Currency::EUR)
    {
        $this->pricePerProduct = $this->rawPrice * (1 - $this->percentage);

        parent::__construct($rawPrice, $rawUnitText, $currency);
    }
}
