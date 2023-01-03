<?php

declare(strict_types=1);

namespace T3Docs\Theme\Repository;

use T3Docs\Theme\Directives\IndexDirective;
use T3Docs\Theme\Model\Index;

class IndexRepository
{
    /** @var Index[] */
    private array $indexArray = [];

    public function addTextAsIndex(string $text) : void {

    }

    /** @retun  array<int, Index> */
    public function getAll() : array {
        usort($this->indexArray, 'Index::sort');
        return $this->indexArray;
    }
}