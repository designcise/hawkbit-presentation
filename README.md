# Hawkbit Presentation

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]
[![Coverage Status][ico-coveralls]][link-coveralls]

Presentation layer for Hawkbit PSR-7 Micro PHP framework.
Hawkbit Persitence uses factories of `dasprid/container-interop-doctrine` and wraps them with in a PresentationService

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

### Full configuration

A full configuration is available on [DASPRiD/container-interop-doctrine/example/full-config.php](https://github.com/DASPRiD/container-interop-doctrine/blob/master/example/full-config.php). 
Refer to [container-interop-doctrine Documentation](https://github.com/DASPRiD/container-interop-doctrine) for further instructions on factories.

### Presentation from Hawbit Application

```php
<?php

/** @var \Hawkbit\Presentation\PresentationServiceInterface $Presentation */
$Presentation = $app[\Hawkbit\Presentation\PresentationServiceInterface::class];

$em = $Presentation->getEntityManager();

// or with from specific connection
$em = $Presentation->getEntityManager('connectionname');

```

### Presentation in a Hawkbit controller

Access Presentation service in controller. Hawbit is inject classes to controllers by default.

```php
<?php

use \Hawkbit\Presentation\PresentationServiceInterface;

class MyController{
    
    /**
     * @var \Hawkbit\Presentation\PresentationServiceInterface 
     */
    private $Presentation = null;
    
    public function __construct(PresentationServiceInterface $Presentation){
        $this->Presentation = $Presentation;
    }
    
    public function index(){
        $em = $this->Presentation->getEntityManager();
        
        // or with from specific connection
        $em = $this->Presentation->getEntityManager('connectionname');
    }
}
```

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
- [All contributors](https://github.com/hawkbit/Presentation/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/hawkbit/Presentation.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/HawkBitPhp/hawkbit-Presentation/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/hawkbit/Presentation.svg?style=flat-square
[ico-coveralls]: https://img.shields.io/coveralls/HawkBitPhp/hawkbit-Presentation/master.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/hawkbit/hawkbit
[link-travis]: https://travis-ci.org/HawkBitPhp/hawkbit
[link-downloads]: https://packagist.org/packages/hawkbit/hawkbit
[link-author]: https://github.com/mbunge
[link-contributors]: ../../contributors
[link-coveralls]: https://coveralls.io/github/HawkBitPhp/hawkbit
