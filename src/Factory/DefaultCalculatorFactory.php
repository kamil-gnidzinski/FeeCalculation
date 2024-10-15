<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Factory;

use PragmaGoTech\Interview\DefaultCalculator;

class DefaultCalculatorFactory implements CaluclatorFactory
{
    public function create(FeeStructureFactory $feeStructureFactory): DefaultCalculator
    {
        return new DefaultCalculator($feeStructureFactory);
    }
}
