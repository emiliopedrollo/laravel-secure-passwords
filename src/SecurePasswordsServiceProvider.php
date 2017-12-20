<?php

namespace Pedrollo\SecurePasswords;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Support\ServiceProvider;

class SecurePasswordsServiceProvider extends ServiceProvider
{

    public function boot(ValidationFactory $factory) {
        $this->publishes([
            __DIR__.'/config/passwords.php' => config_path('passwords.php')
        ]);
        $this->registerRules($factory);
    }

    public function mergeConfig(){
        $this->mergeConfigFrom(__DIR__.'/config/passwords.php','passwords');
    }

    public function register() {
        $this->mergeConfig();
        app()->singleton(SecurePasswords::class, function() {
            return new SecurePasswords();
        });
    }

    protected function registerRules(ValidationFactory $validator){
        $translator = (new SecurePasswordsTranslationProvider())->get($validator);
        $this->registerUpperCaseRule($validator,$translator);
        $this->registerLowerCaseRule($validator,$translator);
        $this->registerBothCasesRule($validator,$translator);
        $this->registerDigitRule($validator,$translator);
        $this->registerLetterRule($validator,$translator);
        $this->registerSymbolRule($validator,$translator);
        $this->registerCommonPasswordRule($validator,$translator);
    }

    protected function registerUpperCaseRule(ValidationFactory $validator, Translator $translator) {
        $validator->extend('has_uppercase', function(/** @noinspection PhpUnusedParameterInspection */$argument, $value) {
            return app(SecurePasswords::class)->hasUpperCase($value);
        },$translator->get('secure-passwords::validation.has_uppercase'));
    }

    protected function registerLowerCaseRule(ValidationFactory $validator, Translator $translator) {
        $validator->extend('has_lowercase', function(/** @noinspection PhpUnusedParameterInspection */$argument, $value) {
            return app(SecurePasswords::class)->hasLowerCase($value);
        },$translator->get('secure-passwords::validation.has_lowercase'));
    }

    protected function registerBothCasesRule(ValidationFactory $validator, Translator $translator) {
        $validator->extend('has_both_cases', function(/** @noinspection PhpUnusedParameterInspection */$argument, $value) {
            return app(SecurePasswords::class)->hasBothCases($value);
        },$translator->get('secure-passwords::validation.has_both_cases'));
    }

    protected function registerDigitRule(ValidationFactory $validator, Translator $translator) {
        $validator->extend('has_digit', function(/** @noinspection PhpUnusedParameterInspection */$argument, $value) {
            return app(SecurePasswords::class)->hasDigit($value);
        },$translator->get('secure-passwords::validation.has_digit'));
    }

    protected function registerLetterRule(ValidationFactory $validator, Translator $translator) {
        $validator->extend('has_letter', function(/** @noinspection PhpUnusedParameterInspection */$argument, $value) {
            return app(SecurePasswords::class)->hasLetter($value);
        },$translator->get('secure-passwords::validation.has_letter'));
    }

    protected function registerSymbolRule(ValidationFactory $validator, Translator $translator) {
        $validator->extend('has_symbol', function(/** @noinspection PhpUnusedParameterInspection */$argument, $value) {
            return app(SecurePasswords::class)->hasSymbol($value);
        },$translator->get('secure-passwords::validation.has_symbol'));
    }

    protected function registerCommonPasswordRule(ValidationFactory $validator, Translator $translator) {
        $validator->extend('not_a_common_password', function(/** @noinspection PhpUnusedParameterInspection */$argument, $value) {
            return app(SecurePasswords::class)->isNotACommonPassword($value);
        },$translator->get('secure-passwords::validation.not_a_common_password'));
    }

}