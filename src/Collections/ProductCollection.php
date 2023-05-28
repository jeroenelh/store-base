<?php

namespace Microit\StoreBase\Collections;

use Microit\StoreBase\Models\Product;

final class ProductCollection extends Collection
{
    public function add(Product $product): void
    {
        $this->values[] = $product;
    }

    public function has(Product $product): bool
    {
        return in_array($product, $this->values);
    }
}
