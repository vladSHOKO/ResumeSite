<?php

namespace App\Controller;

use App\DTO\MailDTO;
use App\Repository\LetterRepository;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class MailController extends AbstractController
{
    #[Route('/send/mail', name: 'app_mail', methods: ['POST'])]
    public function index(Request $request, MailerInterface $mailer, LetterRepository $letterRepository, SerializerInterface $serializer): Response
    {

        try {
            $data = json_decode($request->getContent(), true);

            $formDTO = $serializer->denormalize($data, MailDTO::class, 'json');

            $letterRepository->saveLetter($formDTO);

            $mailerService = new MailerService($mailer, $formDTO);
            $mailerService->replyLetter();
        } catch (TransportExceptionInterface $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response(json_encode('Письмо успешно отправлено!'), Response::HTTP_OK);
    }
}
