<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Iterator;

use PragmaGoTech\Interview\Model\Fee;

class DefaultFeeStructure implements FeeStructure, \Iterator
{
    private array $fees = [];
    private int $currentIndex = 0;

    public function addFee(Fee $fee): void
    {
        $this->fees[] = $fee;
    }

    public function current(): Fee
    {
        return $this->fees[$this->currentIndex];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next(): void
    {
        $this->currentIndex++;
    }

    public function rewind(): void
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->fees[$this->currentIndex]);
    }

    public function getFeeByAmount(float $amount): Fee
    {
        $filteredFees = array_filter($this->fees, fn($fee) => $fee->threshold() === $amount);
        if (!empty($filteredFees)) {
            return reset($filteredFees);
        }

        $feeValue = $this->interpolate($amount);
        return new Fee($amount,$feeValue);
    }

    private function interpolate(float $amount): float
    {
        $amounts = array_map(fn(Fee $fee) => $fee->threshold(), $this->fees);
        $lowerBounds = array_filter($amounts, fn($key) => $key <= $amount);
        $upperBounds = array_filter($amounts, fn($key) => $key > $amount);


        if ($lowerBounds == null || $upperBounds == null) {
            throw new \InvalidArgumentException("Interpolation bounds cannot be null.");
        }

        $lowerBound = max($lowerBounds);
        $upperBound = min($upperBounds);

        $lowerBoundFee = $this->getFeeByAmount($lowerBound)->value();
        $upperBoundFee = $this->getFeeByAmount($upperBound)->value();
        return $lowerBoundFee + (($upperBoundFee - $lowerBoundFee) / ($upperBound - $lowerBound)) * ($amount - $lowerBound);

    }
}