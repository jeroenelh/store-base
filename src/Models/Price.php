<?php

namespace Microit\StoreBase\Models;

class Price
{
    protected Unit $unit;

    protected ?float $normalizedPrice = null;

    public function __construct(public readonly float $rawPrice, public readonly string $rawUnitText, public readonly string $currency = 'EURO')
    {
        $this->unit = Unit::getValidateUnit($this->rawUnitText);
        $normalizedSize = $this->unit->getNormalizedSize();
        if (! is_null($normalizedSize)) {
            $this->normalizedPrice = $this->rawPrice * $normalizedSize;
        }
    }
}
