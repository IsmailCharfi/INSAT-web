<?php

namespace App\Controller;

use App\Entity\FicheNotes;
use App\Form\FicheNotesType;
use App\Repository\FicheNotesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fiche/notes')]
class FicheNotesController extends AbstractController
{
    #[Route('/', name: 'fiche_notes_index', methods: ['GET'])]
    public function index(FicheNotesRepository $ficheNotesRepository): Response
    {
        return $this->render('fiche_notes/index.html.twig', [
            'fiche_notes' => $ficheNotesRepository->findAll(),
            'title' => 'Fiches des notes',
        ]);
    }

    #[Route('/{id}', name: 'fiche_notes_show', methods: ['GET'])]
    public function show(FicheNotes $ficheNote): Response
    {
        return $this->render('fiche_notes/show.html.twig', [
            'fiche_note' => $ficheNote,
            'title' => 'Fiche des notes : ' . $ficheNote->getNom(),
        ]);
    }

    #[Route('/{id}', name: 'fiche_notes_delete', methods: ['POST'])]
    public function delete(Request $request, FicheNotes $ficheNote): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheNote->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ficheNote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fiche_notes_index');
    }
}
