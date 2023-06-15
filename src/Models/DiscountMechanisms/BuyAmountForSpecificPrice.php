<?php

namespace Microit\StoreBase\Models\DiscountMechanisms;

use Microit\StoreBase\Enums\Currency;
use Microit\StoreBase\Models\DiscountMechanism;

/** @psalm-suppress PropertyNotSetInConstructor */
class BuyAmountForSpecificPrice extends DiscountMechanism
{
    /**
     * @param float $rawPrice Total price of all the products
     * @param string $rawUnitText Unit text
     * @param int $amountOfProducts
     * @param Currency $currency
     */
    public function __construct(float $rawPrice, string $rawUnitText, protected int $amountOfProducts, Currency $currency = Currency::EUR)
    {
        parent::__construct($rawPrice, $rawUnitText, $currency);
    }
}
