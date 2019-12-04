<?php

namespace Pedrollo\SecurePasswords\Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Validator;
use Pedrollo\SecurePasswords\SecurePasswords;
use Pedrollo\SecurePasswords\SecurePasswordsServiceProvider;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Class SecurePasswordsServiceProviderTest
 * @package Pedrollo\SecurePasswords
 */
class SecurePasswordsServiceProviderTest extends TestCase {

    /**
     * @return Application|HttpKernelInterface
     * @coversNothing
     */
    public function createApplication() {
        /** @var Application $app */
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        $app->register(SecurePasswordsServiceProvider::class);
        return $app;
    }


    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::register
     */
    public function it_register(){
        $singleton = $this->app->get(SecurePasswords::class);
        $this->assertInstanceOf(SecurePasswords::class,$singleton);
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerRules
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerUpperCaseRule
     */
    public function it_make_has_uppercase_available(){
        $this->assertTrue(Validator::make(
            ['A'],
            ['has_uppercase']
        )->passes());
    }


    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerRules
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerLowerCaseRule
     */
    public function it_make_has_lowercase_available(){
        $this->assertTrue(Validator::make(
            ['a'],
            ['has_lowercase']
        )->passes());
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerRules
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerBothCasesRule
     */
    public function it_make_has_both_cases_available(){
        $this->assertTrue(Validator::make(
            ['Aa'],
            ['has_both_cases']
        )->passes());
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerRules
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerDigitRule
     */
    public function it_make_has_digit_available(){
        $this->assertTrue(Validator::make(
            ['1'],
            ['has_digit']
        )->passes());
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerRules
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerLetterRule
     */
    public function it_make_has_letter_available(){
        $this->assertTrue(Validator::make(
            ['a'],
            ['has_letter']
        )->passes());
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerRules
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerSymbolRule
     */
    public function it_make_has_symbol_available(){
        $this->assertTrue(Validator::make(
            ['!'],
            ['has_symbol']
        )->passes());
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerRules
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerCommonPasswordRule
     */
    public function it_make_not_a_common_password_available(){
        $this->assertTrue(Validator::make(
            ['not_a_common_password'],
            ['not_a_common_password']
        )->passes());
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::boot
     */
    public function it_make_passwords_config_available() {
        $this->assertTrue(config()->has('passwords'));
    }
}
