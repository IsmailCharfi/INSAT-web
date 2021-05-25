<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route ("/", name="homePage")
     */
    public function index(): Response
    {
        return $this->render('HomePage/index.html.twig', [
            'title' => 'INSAT - Institut National des Sciences Appliquées et de Technologie',
            'homepage' => true,
        ]);
    }

    /**
     * @Route("/actualites", name="actualites")
     */
    public function actualites(): Response
    {
        return $this->render('HomePage/actualites.html.twig', [
            'title' => "INSAT - Les Actualités",
        ]);
    }

    /**
     * @Route("/emplois", name="emplois")
     */
    public function emplois(): Response
    {
        return $this->render('HomePage/emplois.html.twig', [
            'title' => "INSAT - Emplois du temps",
        ]);
    }

    /**
     * @Route("/documents", name="documents")
     */
    public function documents(): Response
    {
        return $this->render('HomePage/documents.html.twig', [
            'title' => "INSAT - Documents",
        ]);
    }

}
