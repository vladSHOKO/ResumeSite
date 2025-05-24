<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
class MailFormDTO
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $to;

    #[Assert\NotBlank]
    public string $subject;

    #[Assert\NotBlank]
    public string $message;

    public function __construct(string $to, string $subject, string $message)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
    }

}