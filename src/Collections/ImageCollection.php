<?php

namespace Microit\StoreBase\Collections;

use Microit\StoreBase\Models\Image;

final class ImageCollection extends Collection
{
    public function add(Image $image): void
    {
        $this->values[] = $image;
    }

    public function has(Image $image): bool
    {
        return in_array($image, $this->values);
    }
}
