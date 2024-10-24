# PHPStan Array Merge Rules

This package provides PHPStan rules to satisfy code quality standards for WPForms plugins.

## Installation

You can install the package via composer:

```bash
composer require --dev kkarpieszuk/phpstan-wpforms-rules
```

You cna also install it directly from GitHub:

```bash
composer require --dev kkarpieszuk/phpstan-wpforms-rules:dev-main
```

## Usage

The rules will be automatically registered if you include the package in your PHPStan configuration:

```neon
includes:
    - vendor/kkarpieszuk/phpstan-wpforms-rules/rules.neon
```

## Rules

### DisallowArrayMergeInLoopsRule

This rule prevents the use of `array_merge` inside `foreach` and `for` loops. Using `array_merge` in loops can lead to performance issues due to repeated array copying.

Example of code that will trigger an error:

```php
$result = [];
foreach ($arrays as $array) {
    $result = array_merge($result, $array); // ERROR: Do not use array_merge inside foreach or for loops.
}
```

Alternative solution:

```php
$result = array_merge(...$arrays);
```

## License

The MIT License (MIT).