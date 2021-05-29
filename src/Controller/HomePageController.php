<?php

namespace App\Controller;

use App\Repository\ActualiteRepository;
use App\Repository\EmploiDuTempsRepository;
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
            'title' => 'Institut National des Sciences Appliquées et de Technologie',
            'homepage' => true,
        ]);
    }

    /**
     * @Route("/actualites", name="actualites")
     */
    public function actualites(ActualiteRepository $actualiteRepository): Response
    {
        return $this->render('HomePage/actualites.html.twig', [
            'actualites' => $actualiteRepository->findAll(),
            'title' => "Les Actualités",
        ]);
    }

    /**
     * @Route("/emplois", name="emplois")
     */
    public function emplois(EmploiDuTempsRepository $emploiDuTempsRepository): Response
    {
        return $this->render('HomePage/emplois.html.twig', [
            'sem1' => $emploiDuTempsRepository->findBy(["semestre"=>1]),
            'sem2' => $emploiDuTempsRepository->findBy(["semestre"=>2]),
            'title' => "Emplois du temps",
        ]);
    }

    /**
     * @Route("/documents", name="documents")
     */
    public function documents(): Response
    {
        return $this->render('HomePage/documents.html.twig', [
            'title' => "Documents Utiles",
        ]);
    }

    /**
     * @Route("/usermenu", name="userMenu")
     */
    public function loggedin(): Response
    {
        return $this->render('HomePage/user-menu.html.twig', [
            'title' => 'Menu principal',
        ]);
    }

    /**
     * @Route("/underConstruction/{title}", name="underConstruction")
     */
    public function underConstruction($title): Response
    {
        return $this->render('HomePage/under-construction.html.twig', [
            'title' => $title,
        ]);
    }

}
