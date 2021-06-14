<?php

namespace App\Controller;

use App\Entity\MatiereNiveauFiliere;
use App\Entity\Note;
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
    private $manager;

    public function __construct(EntityManagerInterface $manager, AppDataManager $appDataManager)
    {
        $this->appDataManager = $appDataManager;
        $this->manager = $manager;
    }

    #[Route('/releve', name: 'etudiant_releve')]
    public function releve(): Response
    {

        return $this->showReleve($this->appDataManager->getParametres()->getAnneScolaireCourante());
    }

    #[Route('/historique/{annee}', name: 'etudiant_historique_annee')]
    public function historiqueAnnee($annee): Response
    {
        return $this->showReleve($annee);
    }


    #[Route('/historique/', name: 'etudiant_historique')]
    public function historique($annee): Response
    {
        return $this->showReleve($annee);
    }

    private function showReleve($annee): Response
    {
        $noteRepository = $this->manager->getRepository(MatiereNiveauFiliere::class);
        $semestre1 = $noteRepository->getReleve($this->getUser(), $annee, 1);
        $semestre2 = $noteRepository->getReleve($this->getUser(), $annee, 2);

        return $this->render('espace_etudiant/releve.html.twig', [
            'title' => 'Relevé de notes : ' . Tools::getAnneeScolaireFormatted($annee),
            'semestre1'=> $semestre1,
            'semestre2'=> $semestre2,
        ]);
    }

    #[Route('/notes/{matiere?0}', name: 'etudiant_notes')]
    public function notes($matiere): Response
    {
        return $this->showReleve($matiere);
    }
}
