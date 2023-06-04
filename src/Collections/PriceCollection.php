<?php

namespace Microit\StoreBase\Collections;

use Microit\StoreBase\Models\Price;

final class PriceCollection extends Collection
{
    public function add(Price $price): void
    {
        $this->values[] = $price;
    }

    public function has(Price $price): bool
    {
        return in_array($price, $this->values);
    }
}
