<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\DefaultCalculator;
use PragmaGoTech\Interview\Factory\FeeStructureFactory;
use PragmaGoTech\Interview\Factory\JsonFeeStructureFactory;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Iterator\FeeStructure;
use PragmaGoTech\Interview\Model\Fee;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DefaultCalculator::class)]
class DefaultCalculatorTest extends TestCase
{
    private DefaultCalculator $calculator;
    private FeeStructureFactory $feeStructureFactoryMock;

    protected function setUp(): void
    {
        $this->feeStructureFactoryMock = $this->createMock(JsonFeeStructureFactory::class);
        $this->calculator = new DefaultCalculator($this->feeStructureFactoryMock);
    }

    #[dataProvider('calculateDataProvider')]
    public function testCalculate(int $term,float $amount,float $notRoundedFee,float $expectedFee): void
    {
        $loanProposal = new LoanProposal($term, $amount);
        $mockFeeStructure = $this->createMock(FeeStructure::class);
        $mockFee = new Fee($amount, $notRoundedFee);

        $this->feeStructureFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with($loanProposal->term())
            ->willReturn($mockFeeStructure);

        $mockFeeStructure
            ->expects($this->once())
            ->method('getFeeByAmount')
            ->with($loanProposal->amount())
            ->willReturn($mockFee);

        $result = $this->calculator->calculate($loanProposal);

        $this->assertSame($expectedFee, $result);
    }



    public static function calculateDataProvider(): array
    {
        return [
            [12,12000,169.9,170],
            [12,1500.46,75,75],
            [24,6500.78,40.1,45],
            [24,9900,0,0],
        ];
    }
}
