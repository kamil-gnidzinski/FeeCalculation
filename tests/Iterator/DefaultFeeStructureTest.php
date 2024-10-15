<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Iterator;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Iterator\DefaultFeeStructure;
use PHPUnit\Framework\Attributes\CoversClass;
use PragmaGoTech\Interview\Model\Fee;

#[CoversClass(DefaultFeeStructure::class)]
class DefaultFeeStructureTest extends TestCase
{
    private DefaultFeeStructure $feeStructure;

    protected function setUp(): void
    {
        $this->feeStructure = new DefaultFeeStructure();
    }

    public function testAddFee(): void
    {
        $fee = new Fee(1000.00, 50.00);
        $this->feeStructure->addFee($fee);

        $this->assertSame($fee, $this->feeStructure->current());
    }

    public function testIteratorMethods(): void
    {
        $fee1 = new Fee(1000.00, 50.00);
        $fee2 = new Fee(2000.00, 100.00);
        $this->feeStructure->addFee($fee1);
        $this->feeStructure->addFee($fee2);

        $this->feeStructure->rewind();
        $this->assertTrue($this->feeStructure->valid());
        $this->assertSame($fee1, $this->feeStructure->current());
        $this->feeStructure->next();
        $this->assertSame($fee2, $this->feeStructure->current());
        $this->feeStructure->next();
        $this->assertFalse($this->feeStructure->valid());
    }

    public function testGetFeeByAmountReturnsExistingFee(): void
    {
        $fee = new Fee(1500.00, 75.00);
        $this->feeStructure->addFee($fee);

        $result = $this->feeStructure->getFeeByAmount(1500.00);

        $this->assertSame($fee, $result);
    }

    public function testGetFeeByAmountInterpolatesCorrectly(): void
    {
        $fee1 = new Fee(1000.00, 50.00);
        $fee2 = new Fee(2000.00, 100.00);
        $this->feeStructure->addFee($fee1);
        $this->feeStructure->addFee($fee2);

        $result = $this->feeStructure->getFeeByAmount(1500.00);

        $this->assertEquals(75.00, $result->value());
        $this->assertEquals(1500.00, $result->threshold());
    }

    public function testGetFeeByAmountThrowsExceptionForOutOfBoundsAmount(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->feeStructure->getFeeByAmount(500.00);
    }
}