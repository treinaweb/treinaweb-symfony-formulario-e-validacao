<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HasString extends Constraint
{
    /**
     * Mensagem de validação do usuário
     *
     * @var string
     */
    public $message = 'O valor digitado "{{ value }}" não pode ter a palavra "{{ string }}"';

    /**
     * String a ser validada
     *
     * @var string
     */
    public $string;
}
