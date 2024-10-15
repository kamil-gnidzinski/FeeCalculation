<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Factory;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Factory\DefaultCalculatorFactory;
use PragmaGoTech\Interview\DefaultCalculator;
use PragmaGoTech\Interview\Factory\FeeStructureFactory;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DefaultCalculatorFactory::class)]
class DefaultCalculatorFactoryTest extends TestCase
{
    public function testCreate()
    {
        $feeStructureFactoryMock = $this->createMock(FeeStructureFactory::class);
        $factory = new DefaultCalculatorFactory();

        $calculator = $factory->create($feeStructureFactoryMock);

        $this->assertInstanceOf(DefaultCalculator::class, $calculator);
    }

    public function testCreateWithWrongInterface()
    {
        $wrongInterface = $this->createMock(\stdClass::class);
        $factory = new DefaultCalculatorFactory();

        $this->expectException(\TypeError::class);

        $factory->create($wrongInterface);
    }
}