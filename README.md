# The Search Algorithms Implementation in PHP 8

The search algorithm implementation in PHP 8 to find the value with the query as fast.

# Usage

## Install

### Git Clone

```bash
git clone https://github.com/baygin/php-search-algorithms.git
```

### Composer

```bash
composer require baygin/php-search-algorithms
```

## Binary Search

### Array

```php
$array = [];

for ($index = 0; $index < 100 * 10000; $index++) {
    $array[] = $index + 1;
}

$search = new BinarySearch();

$search ->setCompareCallback(fn ($current, $searchValue) => $current === $searchValue)
    ->setDirectionCallback(fn ($current, $searchValue) => $current < $searchValue)
    ->setArray($array)
    ->setSearchValue(98589)
    ->search();

$foundIndex = $search->getFoundIndex();
$foundValue = $search->getFoundValue();
```

### Arrays in array

```php
$array = [];

for ($index = 0; $index < 100 * 10000; $index++) {
    $array[] = [
        "id" => $index + 1,
        "first" => "Baris {$index}",
        "last" => "Manco {$index}",
    ];
}

$search = new BinarySearch();

$search->setCompareCallback(fn ($current, $searchValue) => $current["id"] === $searchValue)
    ->setDirectionCallback(fn ($current, $searchValue) => $current["id"] < $searchValue)
    ->setArray($array)
    ->setSearchValue(81300)
    ->search();

$foundIndex = $search->getFoundIndex();
$foundValue = $search->getFoundValue();
```

### Objects in array

```php

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
```

## Tests

```bash
composer test
```

## Contributing

If you want to contribute to the development of this library, you can open an issue or submit a pull request.

# License

Licensed under the GPL3. See <a href="https://github.com/baygin/php-search-algorithms/blob/master/LICENSE"> LICENSE </a> for more information.
