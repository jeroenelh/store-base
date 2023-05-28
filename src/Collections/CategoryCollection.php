<?php

namespace Microit\StoreBase\Collections;

use Microit\StoreBase\Models\Category;

final class CategoryCollection extends Collection
{
    public function add(Category $category): void
    {
        $this->values[] = $category;
    }

    public function has(Category $category): bool
    {
        return in_array($category, $this->values);
    }
}
