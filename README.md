# Trashmail Checker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tobischulz/trashmail-checker.svg?style=flat-square)](https://packagist.org/packages/tobischulz/trashmail-checker)
[![Total Downloads](https://img.shields.io/packagist/dt/tobischulz/trashmail-checker.svg?style=flat-square)](https://packagist.org/packages/tobischulz/trashmail-checker)

Validates email addresses of known trashmail/temporary mail/disposable mail providers, managed by your own database, to keep away unserious registrations.

## Installation

You can install the package via composer:

```bash
composer require tobischulz/trashmail-checker
```

Publish all required assets:

```bash
php artisan vendor:publish --provider=TobiSchulz\TrashmailChecker\TrashmailCheckerServiceProvider
```

Migrate your database:

```bash
php artisan migrate
```

## Usage

### Validation Rule

``` php
use TobiSchulz\TrashmailChecker\Rules\NoTrashmail;

class ValidateEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'bail', new NoTrashmail],
        ]);
    }
}
```

### Facade

``` php
use TobiSchulz\TrashmailChecker\Facade\TrashmailChecker;

TrashmailChecker::check('taylor@trashmail.com');
```

### Configuration

TrashmailChecker would let you disable the email check in development (env= local) by setting key ```TRASHMAIL_IN_DEVELOPMENT``` to ```false``` in your .env file.

```
TRASHMAIL_IN_DEVELOPMENT=false
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email tobias@byte.software instead of using the issue tracker.

## Credits

- [Tobias Schulz](https://github.com/:tobischulz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.