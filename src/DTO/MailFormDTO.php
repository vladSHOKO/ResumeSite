<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
class MailFormDTO
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $senderEmail;

    #[Assert\NotBlank]
    public string $subject;

    #[Assert\NotBlank]
    public string $message;

    #[Assert\NotBlank]
    public string $senderName;

    public function __construct(string $to, string $subject, string $message, string $senderName)
    {
        $this->senderEmail = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->senderName = $senderName;
    }

}