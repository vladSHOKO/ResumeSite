<?php

namespace App\Service;

use App\DTO\MailFormDTO;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendMail(MailFormDTO $formDTO): void
    {
        $email = (new Email())
            ->from('vladislavkuzminov111@gamail.com')
            ->to($formDTO->senderEmail)
            ->subject('Обратная связь')
            ->text(
                'Здравствуйте, ' . $formDTO->senderName . '! Я отвечу вам в течение некоторого времени! Если хотите ускорить процесс пишите в телеграм https://t.me/vladislavKuzminov2000'
            );

        $this->mailer->send($email);
    }
}