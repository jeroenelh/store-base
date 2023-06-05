<?php

namespace Microit\StoreBase;

use Microit\StoreBase\Collections\CategoryCollection;
use Microit\StoreBase\Collections\ProductCollection;
use Microit\StoreBase\Models\Category;

abstract class StoreConnector
{
    abstract public function getCategories(): CategoryCollection;

    abstract public function getProductsOfCategory(Category $category): ProductCollection;

    abstract public function getProductsByName(string $name): ProductCollection;
}
