<?php

namespace Microit\StoreBase\Models;

class Image
{
    public function __construct(
        public readonly string $url,
        public readonly ?int $width,
        public readonly ?int $height
    ) {
    }
}
