<?php

declare(strict_types=1);

use Baygin\SearchAlgorithm\BinarySearch\BinarySearch;
use PHPUnit\Framework\TestCase;

final class BinarySearchTest extends TestCase
{
    public function testBinarySearchGetSetSearchValue(): void
    {
        $search = new BinarySearch();

        $this->assertSame(null, $search->getSearchValue());

        $search->setSearchValue(2);

        $this->assertSame(2, $search->getSearchValue());
    }

    public function testBinarySearchSetCompareClosure(): void
    {
        $search = new BinarySearch();

        $this->assertEquals($search, $search->setCompareCallback(fn () => true));
    }

    public function testBinarySearchSetDirectionClosure(): void
    {
        $search = new BinarySearch();

        $this->assertEquals($search, $search->setDirectionCallback(fn () => true));
    }

    public function testBinarySearchGetSetArray(): void
    {
        $array = [
            [
                "id" => 1,
            ],
            [
                "id" => 2,
            ],
            [
                "id" => 3,
            ],
            [
                "id" => 4,
            ]
        ];

        $search = new BinarySearch();

        $this->assertSame([], $search->getArray());

        $search->setArray($array);

        $this->assertSame($array, $search->getArray());
    }

    public function testBinarySearchLoopNormalArray(): void
    {
        $array = [];

        for ($index = 0; $index < 100 * 10000; $index++) {
            $array[] = $index + 1;
        }

        $search = new BinarySearch();
        $search
            ->setCompareCallback(fn ($current, $searchValue) => $current === $searchValue)
            ->setDirectionCallback(fn ($current, $searchValue) => $current < $searchValue)
            ->setArray($array)
            ->setSearchValue(98589)
            ->search();

        $this->assertSame(98588, $search->getFoundIndex());
        $this->assertSame(98589, $search->getFoundValue());

        /**
         * There is not found data
         */
        $search = new BinarySearch();
        $search
            ->setCompareCallback(fn ($current, $searchValue) => $current === $searchValue)
            ->setDirectionCallback(fn ($current, $searchValue) => $current < $searchValue)
            ->setArray($array)
            ->setSearchValue(999999999)
            ->search();

        $this->assertSame(-1, $search->getFoundIndex());
    }

    public function testBinarySearchLoopArraysInArray(): void
    {
        $array = [];

        for ($index = 0; $index < 100 * 10000; $index++) {
            $array[] = [
                "id" => $index + 1,
                "first" => "Baris {$index}",
                "last" => "Manco {$index}",
            ];
        }

        $search = new BinarySearch();
        $search
            ->setCompareCallback(fn ($current, $searchValue) => $current["id"] === $searchValue)
            ->setDirectionCallback(fn ($current, $searchValue) => $current["id"] < $searchValue)
            ->setArray($array)
            ->setSearchValue(81300)
            ->search();

        $foundIndex = $search->getFoundIndex();
        $foundValue = $search->getFoundValue();

        $this->assertSame(81299, $foundIndex);

        $this->assertIsArray($foundValue);

        $this->assertSame([
            "id" => 81300,
            "first" => "Baris 81299",
            "last" => "Manco 81299"
        ], $foundValue);
    }

    public function testBinarySearchLoopObjectsInArray(): void
    {
        $array = [];

        for ($index = 0; $index < 100 * 10000; $index++) {
            $array[] = (object) [
                "id" => $index + 1,
                "first" => "Baris {$index}",
                "last" => "Manco {$index}",
            ];
        }

        $search = new BinarySearch();
        $search
            ->setCompareCallback(fn ($current, $searchValue) => $current->id === $searchValue)
            ->setDirectionCallback(fn ($current, $searchValue) => $current->id < $searchValue)
            ->setArray($array)
            ->setSearchValue(81300)
            ->search();

        $foundIndex = $search->getFoundIndex();
        $foundValue = $search->getFoundValue();

        $this->assertSame(81299, $foundIndex);

        $this->assertIsObject($foundValue);

        $searchValue = new stdClass;
        $searchValue->id = 81300;
        $searchValue->first = "Baris 81299";
        $searchValue->last = "Manco 81299";

        $this->assertEquals($searchValue, $foundValue);
    }
}
