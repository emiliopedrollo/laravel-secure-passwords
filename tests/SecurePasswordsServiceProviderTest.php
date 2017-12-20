<?php

namespace Pedrollo\SecurePasswords;

use Illuminate\Config\Repository;
use Illuminate\Container\EntryNotFoundException;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Validator;

/**
 * Class SecurePasswordsServiceProviderTest
 * @package Pedrollo\SecurePasswords
 */
class SecurePasswordsServiceProviderTest extends TestCase {

    /**
     * @return \Illuminate\Foundation\Application|\Symfony\Component\HttpKernel\HttpKernelInterface
     * @coversNothing
     */
    public function createApplication() {
        /** @var \Illuminate\Foundation\Application $app */
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
        try {
            $singleton = $this->app->get(SecurePasswords::class);
            $this->assertInstanceOf(SecurePasswords::class,$singleton);
        } catch (EntryNotFoundException $e) {
            $this->throwException($e);
        }
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerRules
     * @covers \Pedrollo\SecurePasswords\SecurePasswordsServiceProvider::registerUpperCaseRule
     */
    public function it_make_has_uppercase_available(){
        /** @noinspection PhpUndefinedMethodInspection */
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
        /** @noinspection PhpUndefinedMethodInspection */
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
        /** @noinspection PhpUndefinedMethodInspection */
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
        /** @noinspection PhpUndefinedMethodInspection */
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
        /** @noinspection PhpUndefinedMethodInspection */
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
        /** @noinspection PhpUndefinedMethodInspection */
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
        /** @noinspection PhpUndefinedMethodInspection */
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
