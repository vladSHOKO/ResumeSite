<?php

namespace App\Service;

use App\DTO\MailDTO;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Serializer\SerializerInterface;

class MailerService
{
    private MailerInterface $mailer;

    private MailDTO $mailFormDTO;

    public function __construct(MailerInterface $mailer, MailDTO $mailFormDTO)
    {
        $this->mailer = $mailer;
        $this->mailFormDTO = $mailFormDTO;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function replyLetter(): void
    {
        $email = (new Email())
            ->from($_ENV['MAIL_FROM_ADDRESS'])
            ->to($this->mailFormDTO->email)
            ->subject('Обратная связь')
            ->text(
                'Здравствуйте, ' . $this->mailFormDTO->senderName . '! Я отвечу вам в течение некоторого времени! Если хотите ускорить процесс пишите в телеграм https://t.me/vladislavKuzminov2000'
            );

        $this->mailer->send($email);
    }
}