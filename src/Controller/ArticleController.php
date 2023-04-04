<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(Request $request,ArticleRepository $articleRepository, EntityManagerInterface $entityManager): Response
    {


        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article,
            [
                'codePostal' => '10000'
            ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $articleRepository->save($article, true);
            return $this->redirectToRoute('app_article');
        }

        $articles = $articleRepository->findByPrix('10');
        return $this->render('article/index.html.twig', [
            'form' => $form->createView(),
            'articles' => $articles,
        ]);
    }
}
