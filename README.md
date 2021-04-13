Laravel Secure Passwords
================
[![Build Status](https://travis-ci.org/emiliopedrollo/laravel-secure-passwords.svg?branch=master)](https://travis-ci.org/emiliopedrollo/laravel-secure-passwords)
[![Latest Stable Version](https://poser.pugx.org/emiliopedrollo/laravel-secure-passwords/v/stable)](https://packagist.org/packages/emiliopedrollo/laravel-secure-passwords)
[![Total Downloads](https://poser.pugx.org/emiliopedrollo/laravel-secure-passwords/downloads)](https://packagist.org/packages/emiliopedrollo/laravel-secure-passwords)
[![License](https://poser.pugx.org/emiliopedrollo/laravel-secure-passwords/license)](https://packagist.org/packages/emiliopedrollo/laravel-secure-passwords)
![Code Climate maintainability](https://img.shields.io/codeclimate/maintainability/emiliopedrollo/laravel-secure-passwords)

This package provides useful ways to ensure strong passwords via validation in Laravel 6 applications.

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
