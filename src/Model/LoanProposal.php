<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal
{
    public function __construct(
        private int   $term,
        private float $amount
    )
    {
        if (!in_array($term, [12, 24], true)) {
            throw new \InvalidArgumentException('Term must be either 12 or 24 months.');
        }

        if ($amount < 1000.0 || $amount > 20000.0) {
            throw new \InvalidArgumentException('Amount must be between 1000 and 20000 PLN.');
        }
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function term(): int
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): float
    {
        return $this->amount;
    }
}
