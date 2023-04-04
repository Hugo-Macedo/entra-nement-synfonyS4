<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use App\Repository\FournisseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FournisseurController extends AbstractController
{
    #[Route('/fournisseur', name: 'app_fournisseur')]
    public function new(
        Request $request,
        FournisseurRepository $fournisseurRepository,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $fournisseur);

        $form->handleRequest($request);

        if($form-> isSubmitted()) {
            $fournisseurRepository->save($fournisseur, true);
            return $this->redirectToRoute('app_fournisseur');
        }

        return $this->render('fournisseur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
