<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    #[Route('/{_locale}', name: 'app_home', requirements: [
        '_locale' => 'fr|en',
    ],)]
    public function index(TranslatorInterface $translator, Request $request): Response
    {
        $locale = $request->getLocale();
        $translated = $translator->trans('Bienvenue sur mon site SymfonyS4');


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'translated' => $translated,


        ]);
    }
}
