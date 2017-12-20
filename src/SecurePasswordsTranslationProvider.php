<?php

namespace Pedrollo\SecurePasswords;

use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory as ValidationFactory;

class SecurePasswordsTranslationProvider {
    /**
     * @param ValidationFactory $validator
     * @return Translator
     */
    public function get(ValidationFactory $validator)
    {
        /** @var Translator $translator */
        $translator = $validator->getTranslator();
        $translator->addNamespace('secure-passwords', __DIR__ . '/lang');
        $translator->load('secure-passwords', 'validation', $translator->locale());
        return $translator;
    }
}