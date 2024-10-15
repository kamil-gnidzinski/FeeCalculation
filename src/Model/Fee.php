<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

class Fee
{
    public function __construct(
        private float   $threshold,
        private float $value,
    )
    {
    }

    public function threshold(): float
    {
        return $this->threshold;
    }

    public function value(): float
    {
        return $this->value;
    }
}
