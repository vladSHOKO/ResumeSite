<?php

namespace App\Controller;

use App\DTO\MailFormDTO;
use App\Repository\LetterRepository;
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
    public function index(Request $request, MailerInterface $mailer, LetterRepository $letterRepository): Response
    {
        $data = json_decode($request->getContent(), true);

        $formDTO = new MailFormDTO($data['email'], $data['subject'], $data['message'], $data['name']);

        $letterRepository->saveLetter($formDTO);

        $mailerService = new MailerService($mailer);
        try {
            $mailerService->sendMail($formDTO);
        } catch (TransportExceptionInterface $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response('Письмо успешно отправлено!', Response::HTTP_OK);
    }
}
