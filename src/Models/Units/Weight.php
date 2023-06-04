<?php

namespace Microit\StoreBase\Models\Units;

use Microit\StoreBase\Models\Unit;

class Weight extends Unit
{
    public const KILO = 1;

    public const GRAM = 1000;

    /** @var array|array[] */
    public array $steps = [
        self::KILO => ['kg', 'kilo', 'per kilo', 'kilogram'],
        self::GRAM => ['gr', 'g', 'gram'],
    ];

    public function validate(): bool
    {
        /**
         * @var int $factor
         * @var string[] $possibilities
         */
        foreach ($this->steps as $factor => $possibilities) {
            $this->validateSingleUnit($factor, $possibilities);
            $this->validateTimesUnit($factor, $possibilities);

            if (! is_null($this->normalizedSize)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Examples: 500 gram, 1kilo, 1.5 kilo.
     * @param int $factor
     * @param string[] $possibilities
     */
    private function validateSingleUnit(int $factor, array $possibilities): void
    {
        $pattern = '/^([0-9.]+)([ ]*)('.implode('|', $possibilities).')$/';
        if (preg_match($pattern, $this->rawUnitText, $matches, PREG_UNMATCHED_AS_NULL) && ! is_null($matches[1])) {
            $this->normalizedSize = (float) $matches[1] / $factor;
            $this->normalizedText = (float) $matches[1].' '.$possibilities[0];
        }
    }

    /**
     * Examples: 3 x 500 gram, 2x1kilo.
     * @param int $factor
     * @param string[] $posibilities
     */
    private function validateTimesUnit(int $factor, array $posibilities): void
    {
        $pattern = '/^([0-9.]+)([ ]*)x([ ]*)([0-9.]+)([ ]*)('.implode('|', $posibilities).')$/';
        if (preg_match($pattern, $this->rawUnitText, $matches, PREG_UNMATCHED_AS_NULL) && ! is_null($matches[1]) && ! is_null($matches[4])) {
            $this->normalizedSize = ((float) $matches[1] * (float) $matches[4]) / $factor;
            $this->normalizedText = $matches[1].' x '.$matches[4].' '.$posibilities[0];
        }
    }
}
