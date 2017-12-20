<?php

namespace Pedrollo\SecurePasswords;

class SecurePasswords  {

    public function hasLetter($value) {
        return (bool) preg_match('/\pL/', $value);
    }

    public function hasDigit($value) {
        return (bool) preg_match('/\pN/', $value);
    }

    public function hasSymbol($value) {
        return (bool) preg_match('/[\_\W]/', $value);
    }

    public function hasLowerCase($value) {
        return (bool) preg_match('/^.*(?=.*\p{Ll}).*$/u',$value);
    }

    public function hasUpperCase($value) {
        return (bool) preg_match('/^.*(?=.*\p{Lu}).*$/u',$value);
    }

    public function hasBothCases($value) {
        return (bool) preg_match('/^.*(?=.*\p{Ll})(?=.*\p{Lu}).*$/u',$value);
    }

    public function isNotACommonPassword($value) {
        $common_passwords = config('passwords.common_passwords');
        return (bool) !in_array($value,$common_passwords);
    }
}
