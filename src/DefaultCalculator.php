<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Factory\FeeStructureFactory;
use PragmaGoTech\Interview\Model\LoanProposal;

class DefaultCalculator implements FeeCalculator
{

    public function __construct(
        private FeeStructureFactory $factory,
    )
    {
    }

    public function calculate(LoanProposal $application): float
    {
        $feeStructure = $this->factory->create($application->term());
        $fee = $feeStructure->getFeeByAmount($application->amount());

        return $this->roundToFive($fee->value());
    }

    private function roundToFive(float $amount): float
    {
        return ceil($amount / 5) * 5;
    }

}
