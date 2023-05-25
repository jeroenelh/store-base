<?php

namespace Microit\StoreBase\Models;

class Product
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly ?string $brand
    ) {
    }
}
