<?php

namespace App\Controller;

use App\DTO\MailFormDTO;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class MailController extends AbstractController
{
    #[Route('/send/mail', name: 'app_mail', methods: ['POST'])]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $data = json_decode($request->getContent(), true);

        $formDTO = new MailFormDTO($data['email'], $data['subject'], $data['message']);

        $this->saveEmail($formDTO);

        $mailerService = new MailerService($mailer);
        try {
            $mailerService->sendMail($formDTO);
        } catch (TransportExceptionInterface $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response('Письмо успешно отправлено!', Response::HTTP_OK);
    }

    public function saveEmail(MailFormDTO $formDTO): void
    {

    }
}
