<?php

namespace App\Validator;

use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class UniqueUserEmailValidator extends ConstraintValidator
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        /* @var UniqueUserEmail $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        $user = $this->userRepository->findOneBy(['email' => $value]);
        if ($user) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ email }}', $value)
                ->addViolation();
        }
    }
}
