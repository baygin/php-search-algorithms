<?php

namespace Baygin\SearchAlgorithm\BinarySearch;

use Baygin\SearchAlgorithm\SearchInterface;

interface BinarySearchInterface extends SearchInterface
{
    public function setCompareCallback(callable $closure): self;
    public function setDirectionCallback(callable $closure): self;
}
