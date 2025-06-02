<?php

namespace App\Controller;

use App\DTO\UserDTO;
use App\Service\UserService;
use PHPUnit\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/register', name: 'app_register', methods: ['POST'])]
    public function register(
        Request $request,
        Security $security,
        ValidatorInterface $validator,
    ): Response {
        $data = json_decode($request->getContent(), true);
        $userDTO = new UserDTO($data['email'], $data['password']);
        $errors = $validator->validate($userDTO);

        if (count($errors) > 0) {
            return new Response(json_encode($errors->get(0)->getMessage()), Response::HTTP_BAD_REQUEST);
        }

        $user = $this->userService->createUser($userDTO);
        $this->userService->addUserToDatabase($user);

        return $security->login($user, 'form_login', 'main');
    }

    #[Route('/registration', name: 'app_registration')]
    public function registrationPage(): Response
    {
        return $this->render('registration/index.html.twig');
    }
}
