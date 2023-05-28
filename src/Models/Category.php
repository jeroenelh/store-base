<?php

namespace Microit\StoreBase\Models;

class Category
{
    /** @var Category[] */
    protected array $subCategories = [];

    public function __construct(
        public readonly int|string|null $id = null,
        public readonly ?string         $name = null,
        public readonly ?string         $slug = null,
        public readonly ?string         $url = null,
        public readonly ?Image          $image = null,
    ) {
    }

    public function getId(): int|string|null
    {
        return $this->id;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getSlug(): string|null
    {
        return $this->slug;
    }

    public function getUrl(): string|null
    {
        return $this->url;
    }

    public function getImage(): Image|null
    {
        return $this->image;
    }

    public function addSubCategory(Category $category): Category
    {
        if (!$this->hasSubCategory($category)) {
            $this->subCategories[] = $category;
        }

        return $this;
    }

    public function hasSubCategory(Category $category): bool
    {
        return in_array($category, $this->subCategories);
    }

    public function getSubCategories(): array
    {
        return $this->subCategories;
    }

}
