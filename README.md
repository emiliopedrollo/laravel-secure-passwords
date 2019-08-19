Laravel Secure Passwords
[![Build Status](https://travis-ci.org/emiliopedrollo/laravel-secure-passwords.svg?branch=master)](https://travis-ci.org/emiliopedrollo/laravel-secure-passwords)
================

This package provides useful ways to ensure strong passwords via validation in Laravel 5 applications.

The provided new validations:

- alphabetic characters
- numeric characters
- mixed case characters
- symbols
- common used passwords (provided by SplashData)

# Documentation

## Installation

### Get the package

```composer require emiliopedrollo/laravel-secure-passwords:"~0.2"```.

### Initialize the package

> If you do run the package on Laravel 5.5+, you can start using the package at this point. [package auto-discovery](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518) takes care of the magic of adding the service provider.


If you do not run Laravel 5.5 (or higher), then add the following line under the `providers` array key in *app/config.php*:

```php
// app/config/app.php
return array(
    // ...
    'providers' => array(
        // ...
        \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::class,
    );
    // ...
);
```

## Usage
Now Laravel's native `Validator` is extended by those rules:

- has_uppercase
- has_lowercase
- has_both_cases
- has_digit
- has_letter
- has_symbol
- not_a_common_password

### Example
You can apply these rules as described in the [validation section on Laravel's website](http://laravel.com/docs/validation)

```php
Validator::make(['password' => 'trustno1']
    'password' => 'has_digit|has_letter|not_a_common_password'
)->passes();   // returns false;
```

# History

**[Laravel 5]**

**[0.1]**

- Initial release

# License

This package is under the MIT license. See the complete license:

- [LICENSE](https://github.com/emiliopedrollo/secure-passwords/LICENSE)


## Reporting Issues or Feature Requests

Issues and feature requests are tracked on [GitHub](https://github.com/emiliopedrollo/secure-passwords/issues).
