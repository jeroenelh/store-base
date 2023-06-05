<?php

namespace Microit\StoreBase\Models;

use Microit\StoreBase\Models\Units\Liquid;
use Microit\StoreBase\Models\Units\Pieces;
use Microit\StoreBase\Models\Units\Weight;

class Unit
{
    protected ?string $normalizedText = null;

    protected ?float $normalizedSize = null;

    public const UNIT_CLASSES = [
        Weight::class,
        Liquid::class,
        Pieces::class,
    ];

    public function __construct(public readonly string $rawUnitText)
    {
    }

    public function getNormalizedSize(): ?float
    {
        return $this->normalizedSize;
    }

    public static function getValidateUnit(string $rawUnitText): self
    {
        foreach (self::UNIT_CLASSES as $unitClass) {
            $unit = new $unitClass($rawUnitText);
            if ($unit->validate()) {
                return $unit;
            }
        }

        // Fallback
        return new self($rawUnitText);
    }
}
