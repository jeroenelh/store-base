<?php

namespace Microit\StoreBase\Models\Units;

use Microit\StoreBase\Models\Unit;

class Pieces extends Unit
{
    /**
     * @var string[]
     */
    private array $keywords = [
        'unknown',
        'per stuk',
        'per pakket',
        'per schaal',
        'per doos',
        'per bos',
        'per bosje',
        'per krop',
        'per rol',
        'per blik',
        'per bak',
        'per net',
        'per zak',
        'tros',
        'doos',
        'stuks',
    ];

    public function validate(): bool
    {
        $this->validateSingleKeyword();
        $this->validateMultipleKeyword();
        $this->validateTimesUnit();

        if (! is_null($this->normalizedSize)) {
            return true;
        }

        return false;
    }

    /**
     * Examples: per stuk, per schaal.
     */
    private function validateSingleKeyword(): void
    {
        $pattern = '/^('.implode('|', $this->keywords).')$/';
        if (preg_match($pattern, $this->rawUnitText)) {
            $this->normalizedSize = 1;
            $this->normalizedText = '1 stuks';
        }
    }

    /**
     * Examples: 3 per stuk, 5 per schaal.
     */
    private function validateMultipleKeyword(): void
    {
        $pattern = '/^([0-9.]+)([ ]*)('.implode('|', $this->keywords).')$/';
        if (preg_match($pattern, $this->rawUnitText, $matches, PREG_UNMATCHED_AS_NULL) && ! is_null($matches[1])) {
            $this->normalizedSize = (float) $matches[1];
            $this->normalizedText = $matches[1].' stuks';
        }
    }

    /**
     * Examples: 3 x 2 per schaal.
     */
    private function validateTimesUnit(): void
    {
        $pattern = '/^([0-9.]+)([ ]*)x([ ]*)([0-9.]+)([ ]*)('.implode('|', $this->keywords).')$/';
        if (preg_match($pattern, $this->rawUnitText, $matches, PREG_UNMATCHED_AS_NULL) && ! is_null($matches[1]) && ! is_null($matches[4])) {
            $this->normalizedSize = ((float) $matches[1] * (float) $matches[4]);
            $this->normalizedText = $matches[1].' x '.$matches[4].' stuks';
        }
    }
}
