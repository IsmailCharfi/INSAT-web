<?php

namespace App\Controller;

use App\Repository\ActualiteRepository;
use App\Repository\EmploiDuTempsRepository;
use App\Service\Mailer;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function actualites(Request $request, ActualiteRepository $actualiteRepository, PaginatorInterface $paginator): Response
    {
        $x = $actualiteRepository->findAll()[0];
        $y = array();
        for ($i=0; $i<20; $i++){
            $y[$i] = $x;
    }

        $actualites = $paginator->paginate(
            $y,
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );

        return $this->render('HomePage/actualites.html.twig', [
            'actualites' => $actualites,
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
            'title' => 'Bienvenu ',
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

    /**
     * @Route("/form", name="contact")
     */
    public function contact(Mailer $mailer): Response
    {
        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $from = $_POST["email"];
            $subject = $_POST["subject"];
            $body = $_POST["message"];

            $mailer->send(
                $from,
                "contact.insat@gmail.com",
                $subject,
                "<p> $body  </p>"
            );
        }
        $this->addFlash("success", "Mail envoyé avec succés");
        return $this->redirectToRoute("homePage");
    }

}
