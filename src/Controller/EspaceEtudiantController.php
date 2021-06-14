<?php

namespace App\Controller;

use App\Service\AppDataManager;
use App\Utilities\Tools;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etudiant')]
class EspaceEtudiantController extends AbstractController
{

    private $appDataManager;

    public function __construct(EntityManagerInterface $manager, AppDataManager $appDataManager)
    {
        $this->appDataManager = $appDataManager;
    }

    #[Route('/releve', name: 'etudiant_releve')]
    public function releve(): Response
    {
        return $this->showReleve($this->appDataManager->getParametres()->getAnneScolaireCourante());
    }

    #[Route('/historique/{annee}', name: 'etudiant_historique_annee')]
    public function historique($annee): Response
    {
        return $this->showReleve($annee);
    }

    private function showReleve($annee): Response
    {

        return $this->render('espace_etudiant/releve.html.twig', [
            'title' => 'Relevé de notes : ' . Tools::getAnneeScolaireFormatted($annee),
        ]);
    }
}
