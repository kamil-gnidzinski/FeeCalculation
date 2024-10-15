<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Factory;

use PragmaGoTech\Interview\Iterator\FeeStructure;

interface FeeStructureFactory
{
    public function create(int $term): FeeStructure;
}
