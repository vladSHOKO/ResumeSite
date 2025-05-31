<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthorizationController extends AbstractController
{
    #[Route('/authorization', name: 'app_authorization')]
    public function index(): Response
    {
        return $this->render('authorization/index.html.twig');
    }
}
