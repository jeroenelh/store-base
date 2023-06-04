<?php

namespace Microit\StoreBase\Models;

use Microit\StoreBase\Collections\ImageCollection;
use Microit\StoreBase\Collections\PriceCollection;

class Product
{
    protected ImageCollection $imageCollection;

    protected PriceCollection $priceCollection;

    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly ?string $brand,
        public readonly ?string $description = ''
    ) {
        $this->imageCollection = new ImageCollection();
        $this->priceCollection = new PriceCollection();
    }

    public function setImageCollection(ImageCollection $imageCollection): void
    {
        $this->imageCollection = $imageCollection;
    }

    public function getImageCollection(): ?ImageCollection
    {
        return $this->imageCollection;
    }

    public function addImage(Image $image): void
    {
        $this->imageCollection->add($image);
    }

    public function setPriceCollection(PriceCollection $priceCollection): void
    {
        $this->priceCollection = $priceCollection;
    }

    public function getPriceCollection(): ?PriceCollection
    {
        return $this->priceCollection;
    }

    public function addPrice(Price $price): void
    {
        $this->priceCollection->add($price);
    }
}
