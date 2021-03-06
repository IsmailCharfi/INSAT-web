<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Form\NiveauType;
use App\Repository\NiveauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/niveau')]
class NiveauController extends AbstractController
{
    #[Route('/', name: 'niveau_index', methods: ['GET'])]
    public function index(NiveauRepository $niveauRepository): Response
    {
        return $this->render('niveau/index.html.twig', [
            'niveaux' => $niveauRepository->findAll(),
            'title' => 'Niveaux',
        ]);
    }

    #[Route('/new', name: 'niveau_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $niveau = new Niveau();
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($niveau);
            $entityManager->flush();

            $this->addFlash('success',"Niveau : ".$niveau->getNiveauName()." ajouté avec succès" );

            return $this->redirectToRoute('niveau_index');
        }

        return $this->render('niveau/new.html.twig', [
            'niveau' => $niveau,
            'form' => $form->createView(),
            'title' => 'Ajouter un niveau',
        ]);
    }

    #[Route('/{id}', name: 'niveau_show', methods: ['GET'])]
    public function show(Niveau $niveau): Response
    {
        return $this->render('niveau/show.html.twig', [
            'niveau' => $niveau,
            'title' => 'Niveau : '.$niveau->getNiveau(),
        ]);
    }

    #[Route('/{id}/edit', name: 'niveau_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Niveau $niveau): Response
    {
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success',"Niveau : " . $niveau->getNiveauName()." modifié avec succès" );

            return $this->redirectToRoute('niveau_index');
        }

        return $this->render('niveau/edit.html.twig', [
            'niveau' => $niveau,
            'form' => $form->createView(),
            'title' => 'Modifier un niveau',
        ]);
    }

    #[Route('/{id}', name: 'niveau_delete', methods: ['POST'])]
    public function delete(Request $request, Niveau $niveau): Response
    {
        if ($this->isCsrfTokenValid('delete'.$niveau->getId(), $request->request->get('_token'))) {

            $this->addFlash('warning',"Niveau : ". $niveau->getNiveauName(). " est supprimé" );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($niveau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('niveau_index');
    }
}
