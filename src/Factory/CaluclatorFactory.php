<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Factory;

use PragmaGoTech\Interview\FeeCalculator;

interface CaluclatorFactory
{
    public function create(FeeStructureFactory $feeStructureFactory): FeeCalculator;
}
