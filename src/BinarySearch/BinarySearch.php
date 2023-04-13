<?php

namespace Baygin\SearchAlgorithm\BinarySearch;

use Baygin\SearchAlgorithm\SearchAbstract;
use InvalidArgumentException;

final class BinarySearch extends SearchAbstract
{
    /**
     * Custom compare query
     */
    protected mixed $compareCallback = null;

    /**
     * Direction function
     */
    protected mixed $directionCallback = null;

    public function search(): void
    {
        if (!$this->array) {
            throw new InvalidArgumentException('The $array attribute must be an instance of the array type. Set attribute using by $class->setArray($array)');
        }

        if (!$this->searchValue) {
            throw new InvalidArgumentException('The $searchValue attribute must be instance of the type in string or int. Set attribute using by $class->setSearchValue($searchValue)');
        }

        if (!$this->compareCallback) {
            throw new InvalidArgumentException('The $compareCallback attribute must be instance of the type callback. Set attribute using by $class->setCompareClass(fn($a, $b) => $a > $b)');
        }

        if (!$this->directionCallback) {
            throw new InvalidArgumentException('The $directionCallback attribute must be instance of the type callback. Set attribute using by $class->setDirectionClass(fn($a, $b) => $a > $b)');
        }

        $this->loop();
    }

    /**
     * Set the custom query as function
     * @param callable $callback
     * @return self
     */
    public function setCompareCallback(callable $callback): self
    {
        $this->compareCallback = $callback;
        return $this;
    }

    /**
     * Set the custom direction as function
     * @param callable $callback
     * @return self
     */
    public function setDirectionCallback(callable $callback): self
    {
        $this->directionCallback = $callback;
        return $this;
    }

    protected function loop(): void
    {
        $low = 0;
        $high = $this->arrayCount - 1;

        while ($high - $low > 1) {
            $middle = ($low + $high) / 2;
            $guess = $this->array[$middle];

            if (($this->compareCallback)($guess, $this->searchValue)) {
                $this->foundIndex = $middle;
                $this->foundValue = $guess;
                break;
            } else if (($this->directionCallback)($guess, $this->searchValue)) {
                $low = $middle;
            } else {
                $high = $middle;
            }
        }
    }
}
