<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Iterator;

use PragmaGoTech\Interview\Model\Fee;

interface FeeStructure
{
    public function getFeeByAmount(float $amount): Fee;
}
