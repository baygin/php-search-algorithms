<?php

namespace Baygin\SearchAlgorithm;

use Baygin\SearchAlgorithm\SearchInterface;
use InvalidArgumentException;

abstract class SearchAbstract implements SearchInterface
{
    /**
     * It will search in this
     */
    protected array $array = [];
    protected int $arrayCount = 0;

    /**
     * Expected value 
     */
    protected null|int|string $searchValue = null;

    /**
     * The found data in which index
     */
    protected int|string $foundIndex = -1;

    /**
     * The found data
     */
    protected mixed $foundValue = null;

    /**
     * Array: array <- default
     * Arrays in array: arrays in array
     * Objects in array: objects in array
     */
    protected $types = [
        "array",
        "arrays in array",
        "objects in array",
    ];
    protected $type = "array";

    /**
     * @return int|string
     */
    public function getFoundIndex(): int|string
    {
        return $this->foundIndex;
    }

    /**
     * @return mixed
     */
    public function getFoundValue(): mixed
    {
        return $this->foundValue;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }

    /**
     * @param array $array 
     * @return self
     */
    public function setArray(array $array): self
    {
        $this->array = $array;
        $this->arrayCount = count($this->array);
        return $this;
    }

    /**
     * @return null|int|string
     */
    public function getSearchValue(): null|int|string
    {
        return $this->searchValue;
    }

    /**
     * @param int|string $searchValue 
     * @return self
     */
    public function setSearchValue(int|string $searchValue): self
    {
        $this->searchValue = $searchValue;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        if (!in_array($type, $this->types)) {
            throw new InvalidArgumentException("The type must be in 'array', 'arrays in array' or 'objects in array'.");
        }

        $this->type = $type;

        return $this;
    }

    abstract public function search(): void;
}
