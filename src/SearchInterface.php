<?php

namespace Baygin\SearchAlgorithm;

interface SearchInterface
{
    public function setArray(array $array): self;

    public function getArray(): ?array;

    public function setSearchValue(int|string $searchValue): self;

    public function getSearchValue(): null|int|string;

    public function getFoundIndex(): null|int|string|bool;

    public function getFoundValue(): mixed;

    public function search(): void;
}
