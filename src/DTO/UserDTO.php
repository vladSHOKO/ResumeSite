<?php

namespace App\DTO;

use App\Validator\UniqueUserEmail;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class UserDTO
{
    #[Assert\NotBlank]
    #[Assert\Email(message: "Введён невалидный email")]
    #[UniqueUserEmail]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\PasswordStrength(minScore: PasswordStrength::STRENGTH_MEDIUM, message: 'Пароль слишком простой! Усложните его.')]
    public string $plainPassword;
    public function __construct(string $email, string $plainPassword)
    {
        $this->email = $email;
        $this->plainPassword = $plainPassword;
    }
}