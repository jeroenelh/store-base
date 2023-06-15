<?php

namespace Microit\StoreBase\Models;

use Microit\StoreBase\Enums\Currency;
use ReflectionProperty;

/** @psalm-suppress PropertyNotSetInConstructor */
class Price
{
    protected Unit $unit;

    protected ?float $normalizedPrice = null;

    protected int $amountOfProducts = 1;

    protected float $pricePerProduct;

    public function __construct(
        public readonly float $rawPrice,
        public readonly string $rawUnitText,
        public readonly Currency $currency = Currency::EUR
    ) {
        $this->unit = Unit::getValidateUnit($this->rawUnitText);
        $normalizedSize = $this->unit->getNormalizedSize();

        if (! is_null($normalizedSize)) {
            $this->normalizedPrice = $this->rawPrice / $normalizedSize;
        }

        if (! (new ReflectionProperty(self::class, 'pricePerProduct'))->isInitialized($this)) {
            $this->pricePerProduct = $this->rawPrice / $this->amountOfProducts;
        }
    }
}
