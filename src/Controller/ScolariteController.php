<?php

namespace App\Controller;


use App\Entity\Filiere;
use App\Form\ScolariteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScolariteController extends AbstractController
{
    #[Route('/scolarite', name: 'scolarite')]
    public function index(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository('App:Filiere');
        $filiere = $repository->findall();
        $filieres=array();
        foreach($filiere as $fil){
            $niveau=$fil->getNiveaux();
            $fila=$fil->getFiliere();
            $fileres[$fila]=array();
            foreach($niveau as $niv){
                array_push($fileres[$fila],$niv->getNiveau());
            }

    }



        return $this->render('scolarite/index.html.twig', [
            'controller_name' => 'ScolariteController',
            'filieres'=>$fileres

        ]);
    }



    #[Route('/notes}', name: 'notes')]
    public function notes(Request $request): Response
    {



        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'ScolariteController',
            'form' => $form->createView()
        ]);
    }
}
