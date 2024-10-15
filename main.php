<?php

require 'vendor/autoload.php';

use PragmaGoTech\Interview\Model\LoanProposal;
use Dotenv\Dotenv;
use PragmaGoTech\Interview\Factory\DefaultCalculatorFactory;
use PragmaGoTech\Interview\Factory\JsonFeeStructureFactory;

$sampleData = [
    [
        'amount' => 2000,
        'term' => 12,
    ],
    [
        'amount' => 3000,
        'term' => 12,
    ],
    [
        'amount' => 4000,
        'term' => 12,
    ],
    [
        'amount' => 5000,
        'term' => 12,
    ],
    [
        'amount' => 14563.98,
        'term' => 24,
    ],
    [
        'amount' => 8563.98,
        'term' => 12,
    ],
];

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$feeStructureFactory = new JsonFeeStructureFactory();

$calculator = (new DefaultCalculatorFactory())->create($feeStructureFactory);
foreach ($sampleData as $data) {
    $application = new LoanProposal($data['term'],$data['amount']);
    $result = $calculator->calculate($application);
    echo sprintf('Amount: %s PLN | Term: %s | Fee: %s PLN',$application->amount(),$application->term(),$result).PHP_EOL;
}