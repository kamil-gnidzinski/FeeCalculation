<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Factory;

use PragmaGoTech\Interview\Iterator\DefaultFeeStructure;
use PragmaGoTech\Interview\Iterator\FeeStructure;
use PragmaGoTech\Interview\Model\Fee;

class JsonFeeStructureFactory implements FeeStructureFactory
{
    public function __construct()
    {
    }

    public function create(int $term): FeeStructure
    {
        switch ($term) {
            case 12:
                $filePath = $_ENV['TERM_12_FEES_CONFIG'];
                break;
            case 24:
                $filePath = $_ENV['TERM_24_FEES_CONFIG'];
                break;
            default:
                throw new \InvalidArgumentException('Term not found');
        }

        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("JSON file not found: ");
        }
        $jsonData = file_get_contents($filePath);

        $feeStructure = new DefaultFeeStructure();
        foreach (json_decode($jsonData, true) as $feeData) {
            $feeStructure->addFee(new Fee($feeData['amount'], $feeData['fee']));
        }

        return $feeStructure;
    }
}
