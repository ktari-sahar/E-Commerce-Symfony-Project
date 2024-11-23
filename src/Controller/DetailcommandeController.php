<?php

namespace App\Controller;

use App\Entity\Detailcommande;
use App\Form\DetailcommandeType;
use App\Repository\DetailcommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/detailcommande')]
final class DetailcommandeController extends AbstractController
{
    #[Route(name: 'app_detailcommande_index', methods: ['GET'])]
    public function index(DetailcommandeRepository $detailcommandeRepository): Response
    {
        return $this->render('detailcommande/index.html.twig', [
            'detailcommandes' => $detailcommandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_detailcommande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $detailcommande = new Detailcommande();
        $form = $this->createForm(DetailcommandeType::class, $detailcommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($detailcommande);
            $entityManager->flush();

            return $this->redirectToRoute('app_detailcommande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detailcommande/new.html.twig', [
            'detailcommande' => $detailcommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detailcommande_show', methods: ['GET'])]
    public function show(Detailcommande $detailcommande): Response
    {
        return $this->render('detailcommande/show.html.twig', [
            'detailcommande' => $detailcommande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_detailcommande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Detailcommande $detailcommande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetailcommandeType::class, $detailcommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_detailcommande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detailcommande/edit.html.twig', [
            'detailcommande' => $detailcommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detailcommande_delete', methods: ['POST'])]
    public function delete(Request $request, Detailcommande $detailcommande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailcommande->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($detailcommande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_detailcommande_index', [], Response::HTTP_SEE_OTHER);
    }
}
