<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Tests\Factory;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Factory\JsonFeeStructureFactory;
use PragmaGoTech\Interview\Iterator\DefaultFeeStructure;
use PragmaGoTech\Interview\Model\Fee;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(JsonFeeStructureFactory::class)]
class JsonFeeStructureFactoryTest extends TestCase
{
    private JsonFeeStructureFactory $factory;

    protected function setUp(): void
    {
        $dotenv = Dotenv::createImmutable('/app');
        $dotenv->load();
        $this->factory = new JsonFeeStructureFactory();
    }
    #[dataProvider('createDataProvider')]
    public function testCreate(int $term): void
    {
        $feeStructure = $this->factory->create($term);

        $this->assertInstanceOf(DefaultFeeStructure::class, $feeStructure);
        $this->assertInstanceOf(Fee::class, $feeStructure->current());
    }

    public function testCreateWithInvalidTerm(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->factory->create(36);
    }

    public static function createDataProvider(): array
    {
        return [
            [12],
            [24],
        ];
    }
}