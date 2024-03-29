# Manage connections to your servers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/modstore/connection-manager.svg?style=flat-square)](https://packagist.org/packages/modstore/connection-manager)
[![Total Downloads](https://img.shields.io/packagist/dt/modstore/connection-manager.svg?style=flat-square)](https://packagist.org/packages/modstore/connection-manager)

A simple way to store and connect to your project's ssh connections. E.g.
```
| # | Name   | Details              |
|---|--------|----------------------|
| 1 | db     | forge@db.myhost.com  |
| 2 | worker | forge@168.104.172.20 |

Please select a connection (# or name):
```

Note that this package is only intended to be used in the local environment and won't be registered in production etc.

## Installation

You can install the package via composer:

```bash
composer require modstore/connection-manager
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="connection-manager-migrations"
php artisan migrate
```

## Usage

List available connections, then select the one to connect to. Optionally the name of the connection can 
be provided to connect straight away without selecting from the list.
```
php artisan connect {name?}
```

Add a new connection
```
php artisan connect:add
```

Remove a connection
```
php artisan connect:remove
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [mark.whitney](https://github.com/modstore)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
