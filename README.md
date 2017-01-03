# Hawkbit Presentation

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]
[![Coverage Status][ico-coveralls]][link-coveralls]

Presentation layer for Hawkbit PSR-7 Micro PHP framework.
Hawkbit Presentation uses [`league/plates`](http://platesphp.com/) as view engine and wraps it with in a PresentationService

## Install

### Using Composer

Hawkbit Presentation is available on [Packagist][link-packagist] and can be installed using [Composer](https://getcomposer.org/). This can be done by running the following command or by updating your `composer.json` file.

```bash
composer require hawkbit/Presentation
```

composer.json

```javascript
{
    "require": {
        "hawkbit/Presentation": "~1.0"
    }
}
```

Be sure to also include your Composer autoload file in your project:

```php
<?php

require __DIR__ . '/vendor/autoload.php';
```

### Downloading .zip file

This project is also available for download as a `.zip` file on GitHub. Visit the [releases page](https://github.com/hawkbit/Presentation/releases), select the version you want, and click the "Source code (zip)" download button.

### Requirements

The following versions of PHP are supported by this version.

* PHP 5.5
* PHP 5.6
* PHP 7.0
* PHP 7.1
* HHVM

## Setup

Setup with an existing application configuration (we refer to [tests/assets/config.php](tests/assets/config.php))

```php
<?php

use \Hawkbit\Application;
use \Hawkbit\Presentation\PresentationService;
use \Hawkbit\Presentation\PresentationServiceProvider;

$app = new Application(require_once __DIR__ . '/config.php');

$app->register(new PresentationServiceProvider([
    'default' => __DIR__ . '/path/to/templates',
    'another' => __DIR__ . '/path/to/other/templates',
]));
```

### Presentation from Hawbit Application

```php
<?php

/** @var \Hawkbit\Presentation\PresentationService $Presentation */
$service = $app[\Hawkbit\Presentation\PresentationService::class];

```

### Presentation in a Hawkbit controller

Access Presentation service in controller. Hawbit is inject classes to controllers by default.

```php
<?php

use \Hawkbit\Presentation\PresentationService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class MyController
{
    /**
     * @var PresentationService
     */
    private $presentationService;

    /**
     * TestInjectableController constructor.
     * @param PresentationService $presentation
     */
    public function __construct(PresentationService $presentation)
    {
        $this->presentationService = $presentation;
    }

    public function getIndex(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $response->getBody()->write($this->presentationService->render('index', ['world' => 'World']));
        return $response;
    }
}
```

### Access and extend engine

In most cases you would like to extend or access plates. We recommend to extend plates
in a central point of your application like bootstrap or even better in your project service provider.

```php
<?php

use Hawkbit\Presentation\PresentationService;

/** @var PresentationService $service */
$service = $app->getContainer()->get(PresentationService::class);
$service->getEngine()
    ->addFolder('acme', __DIR__ . '/templates/acme')
    ->registerFunction('uppercase', function ($string) {
        return strtoupper($string);
    });

```

### Plates

Please refer to [plates documentation](http://platesphp.com) for more details.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email <mjls@web.de> instead of using the issue tracker.

## Credits

- [Marco Bunge](https://github.com/mbunge)
- [Jonathan Reinik (Plates)](https://github.com/reinink)
- [All contributors](https://github.com/hawkbit/Presentation/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/hawkbit/presentation.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/HawkBitPhp/hawkbit-presentation/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/hawkbit/presentation.svg?style=flat-square
[ico-coveralls]: https://img.shields.io/coveralls/HawkBitPhp/hawkbit-presentation/master.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/hawkbit/presentation
[link-travis]: https://travis-ci.org/HawkBitPhp/hawkbit-presentation
[link-downloads]: https://packagist.org/packages/hawkbit/presentation
[link-author]: https://github.com/mbunge
[link-contributors]: ../../contributors
[link-coveralls]: https://coveralls.io/github/HawkBitPhp/hawkbit-presentation
