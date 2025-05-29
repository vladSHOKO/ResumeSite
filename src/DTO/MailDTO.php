<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
class MailDTO
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    public string $subject;

    #[Assert\NotBlank]
    public string $message;

    #[Assert\NotBlank]
    public string $senderName;

    public function __construct(string $email, string $subject, string $message, string $name)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->senderName = $name;
    }

}