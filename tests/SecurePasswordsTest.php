<?php

namespace Pedrollo\SecurePasswords\Tests;

use Illuminate\Foundation\Application;
use Pedrollo\SecurePasswords\SecurePasswords;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase;
use Pedrollo\SecurePasswords\SecurePasswordsServiceProvider;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Class SecurePasswordsTest
 * @package Pedrollo\SecurePasswords\Test
 * @covers \Pedrollo\SecurePasswords\SecurePasswords
 */
class SecurePasswordsTest extends TestCase
{
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
     * @coversNothing
     */
    public function it_can_be_available_as_singleton() {
        $this->assertInstanceOf(SecurePasswords::class,app(SecurePasswords::class));
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswords::hasLetter
     */
    public function it_can_test_for_letters() {
        $securePassword = app(SecurePasswords::class);
        $this->assertTrue($securePassword->hasLetter("a"));
        $this->assertTrue($securePassword->hasLetter("á"));
        $this->assertFalse($securePassword->hasLetter("1"));
        $this->assertTrue($securePassword->hasLetter("abc123"));
        $this->assertFalse($securePassword->hasLetter("123"));
        $this->assertTrue($securePassword->hasLetter("abc"));
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswords::hasDigit
     */
    public function it_can_test_for_digits() {
        $securePassword = app(SecurePasswords::class);
        $this->assertFalse($securePassword->hasDigit("a"));
        $this->assertFalse($securePassword->hasDigit("á"));
        $this->assertTrue($securePassword->hasDigit("1"));
        $this->assertTrue($securePassword->hasDigit("abc123"));
        $this->assertTrue($securePassword->hasDigit("123"));
        $this->assertFalse($securePassword->hasDigit("abc"));
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswords::hasLowerCase
     */
    public function it_can_test_for_lower_case() {
        $securePassword = app(SecurePasswords::class);
        $this->assertFalse($securePassword->hasLowerCase("A"));
        $this->assertFalse($securePassword->hasLowerCase("Á"));
        $this->assertTrue($securePassword->hasLowerCase("a"));
        $this->assertTrue($securePassword->hasLowerCase("á"));
        $this->assertTrue($securePassword->hasUpperCase("Aa"));
        $this->assertTrue($securePassword->hasUpperCase("Aá"));
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswords::hasUpperCase
     */
    public function it_can_test_for_upper_case() {
        $securePassword = app(SecurePasswords::class);
        $this->assertFalse($securePassword->hasUpperCase("a"));
        $this->assertFalse($securePassword->hasUpperCase("á"));
        $this->assertTrue($securePassword->hasUpperCase("A"));
        $this->assertTrue($securePassword->hasUpperCase("Á"));
        $this->assertTrue($securePassword->hasUpperCase("Aa"));
        $this->assertTrue($securePassword->hasUpperCase("Áa"));
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswords::hasBothCases
     */
    public function it_can_test_for_both_cases() {
        $securePassword = app(SecurePasswords::class);
        $this->assertFalse($securePassword->hasBothCases("aa"));
        $this->assertFalse($securePassword->hasBothCases("aá"));
        $this->assertFalse($securePassword->hasBothCases("áa"));
        $this->assertFalse($securePassword->hasBothCases("áá"));
        $this->assertTrue($securePassword->hasBothCases("Aa"));
        $this->assertTrue($securePassword->hasBothCases("Aá"));
        $this->assertTrue($securePassword->hasBothCases("Áa"));
        $this->assertTrue($securePassword->hasBothCases("Áá"));
        $this->assertFalse($securePassword->hasBothCases("AA"));
        $this->assertFalse($securePassword->hasBothCases("AÁ"));
        $this->assertFalse($securePassword->hasBothCases("ÁA"));
        $this->assertFalse($securePassword->hasBothCases("ÁÁ"));
    }

    /**
     * @test
     * @covers       \Pedrollo\SecurePasswords\SecurePasswords::hasSymbol
     * @dataProvider symbol_provider
     * @param $symbol string
     */
    public function it_can_test_for_symbol($symbol) {
        $securePassword = app(SecurePasswords::class);
        $this->assertTrue($securePassword->hasSymbol($symbol),
            "symbol $symbol could not be identified as symbol");
    }
    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswords::hasSymbol
     */
    public function it_can_test_for_symbol_on_non_symbol() {
        $securePassword = app(SecurePasswords::class);
        $this->assertFalse($securePassword->hasSymbol("a"));
        $this->assertFalse($securePassword->hasSymbol("test"));
        $this->assertFalse($securePassword->hasSymbol("123456"));
        $this->assertFalse($securePassword->hasSymbol("trustNo1"));
    }

    /**
     * @test
     * @covers \Pedrollo\SecurePasswords\SecurePasswords::isNotACommonPassword()
     */
    public function it_can_test_if_is_not_a_common_password() {
        /** @var SecurePasswords $securePassword */
        $securePassword = app(SecurePasswords::class);
        $this->assertTrue($securePassword->isNotACommonPassword('not_a_common_password'));
        $this->assertFalse($securePassword->isNotACommonPassword('123456'));
    }

    public function symbol_provider(){
        return [[' '],['!'],['@'],['#'],['$'],['%'],['^'],['&'],['*'],['?'],['('],[')'],['-'],['_'],['='],['+'],
            ['`'],['´'],['['],[']'],['^'],['~'],['ª'],['º'],['°'],['¹'],['²'],['³'],['"'],['\''],['£'],['¢'],
            ['¢'],['¬'],['¨'],['§'],['|'],['{'],['}'],[';'],[':'],[','],['<'],['.'],['>'],['/'],['\\'],['é'],['ø']
        ];
    }
}
