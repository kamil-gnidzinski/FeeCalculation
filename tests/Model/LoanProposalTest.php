<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Model;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\LoanProposal;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LoanProposal::class)]
class LoanProposalTest extends TestCase
{

    #[dataProvider('validDataProvider')]
    public function testValidLoanProposal(int $term,float $amount): void
    {
        $loanProposal = new LoanProposal($term, $amount);

        $this->assertSame($term, $loanProposal->term());
        $this->assertSame($amount, $loanProposal->amount());
    }

    #[dataProvider('invalidTermDataProvider')]
    public function testInvalidTermThrowsException(int $term): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new LoanProposal($term, 15000.00);
    }

    #[dataProvider('invalidAmountDataProvider')]
    public function testInvlidAmountThrowsException(float $amount): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new LoanProposal(12, $amount);
    }

    public static function validDataProvider(): array
    {
        return [
            [12,1000],
            [12,20000],
            [24,20000],
            [24,1000],
            [12,4567.78],
            [24,1578.43],
        ];
    }

    public static function invalidTermDataProvider(): array
    {
        return [
            [11],
            [6],
            [25],
            [36],
        ];
    }

    public static function invalidAmountDataProvider(): array
    {
        return [
            [234],
            [999.99],
            [20000.10],
            [99999]
        ];
    }

}