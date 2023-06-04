<?php

namespace Microit\StoreBase\Models;

use Microit\StoreBase\Collections\ImageCollection;
use Microit\StoreBase\Collections\PriceCollection;

class Product
{
    protected ?ImageCollection $imageCollection;

    protected ?PriceCollection $priceCollection;

    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly ?string $brand,
        public readonly ?string $description = ''
    ) {
        $this->imageCollection = null;
        $this->priceCollection = null;
    }

    public function setImageCollection(ImageCollection $imageCollection): void
    {
        $this->imageCollection = $imageCollection;
    }

    public function getImageCollection(): ?ImageCollection
    {
        return $this->imageCollection;
    }

    public function setPriceCollection(PriceCollection $priceCollection): void
    {
        $this->priceCollection = $priceCollection;
    }

    public function getPriceCollection(): ?PriceCollection
    {
        return $this->priceCollection;
    }
}
