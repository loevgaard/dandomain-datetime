# Dandomain date time library

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]

## Install

Via Composer

``` bash
$ composer require loevgaard/dandomain-datetime
```

## Usage

```php
<?php

$dt = new \Loevgaard\DandomainDateTime\DateTimeImmutable();

// $dt is now a date time object with the timezone set to Europe/Copenhagen
```

## Testing

``` bash
$ composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/loevgaard/dandomain-datetime.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/loevgaard/dandomain-datetime/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/loevgaard/dandomain-datetime.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/loevgaard/dandomain-datetime.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/loevgaard/dandomain-datetime
[link-travis]: https://travis-ci.org/loevgaard/dandomain-datetime
[link-scrutinizer]: https://scrutinizer-ci.com/g/loevgaard/dandomain-datetime/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/loevgaard/dandomain-datetime
