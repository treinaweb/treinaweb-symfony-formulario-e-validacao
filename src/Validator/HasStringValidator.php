<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class HasStringValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof HasString) {
            throw new UnexpectedTypeException($constraint, HasString::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

       if (strpos($value, $constraint->string)) {
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->setParameter('{{ string }}', $constraint->string)
                ->addViolation();
       }
    }
}
