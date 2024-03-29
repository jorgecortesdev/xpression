# Xpression

[![Tests](https://github.com/jorgecortesdev/xpression/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/jorgecortesdev/xpression/actions/workflows/run-tests.yml)

This is a just for fun implementation of the Shunting Yard Algorithm, it was only meant to be research of the algorithm and experiments during the implementation.

## Installation

Just clone the repo:

```bash
git clone https://github.com/jorgecortesdev/xpression
```


## Usage

It includes a controller class called Calculator that can be used as:

```php
$expression = "1 + 2 * 3";

$calculator = new Calculator(new SimpleTokenizer, new ShuntingYard, new Postfix);
echo $calculator->read($expression)->evaluate();
```

It can resolve a more complex expressions like:

```php
$expression = "8 + ( 4 * 2 ) / ( 4 - 2 ) ^ 2";

$calculator = new Calculator(new SimpleTokenizer, new ShuntingYard, new Postfix);
echo $calculator->read($expression)->evaluate();
```

## Notes

 - The expression needs to be separated by spaces, this is due SimpleTokenizer class.
 - The supported operators are:
     - \+
     - /
     - \*
     - ^
     - \-

## Tests

To see what is currently tested you can use:

```bash
composer install
composer test
```

