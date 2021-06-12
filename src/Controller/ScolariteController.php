<?php

namespace App\Controller;


use App\Entity\Filiere;
use App\Entity\Note;
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
        $repository2 = $this->getDoctrine()->getRepository('App:MatiereNiveauFiliere');
        $filiere = $repository->findall();


        $filieres=array();
        foreach($filiere as $fil){
            $niveau=$fil->getNiveaux();
            $fila=$fil->getFiliere();
            $filieres[$fila]=array();
            foreach($niveau as $niv){
                array_push($filieres[$fila],$niv->getNiveau());


    }
        }



        return $this->render('scolarite/index.html.twig', [
            'controller_name' => 'ScolariteController',
            'filieres'=>$filieres,
             'title' => 'Scolarite',

        ]);
    }


    #[Route('/scolarite/{semester}/{filiere}/{niveau}/{matiere}/{type}', name: 'notes')]
    public function notes(Request $request,int $semester,string $filiere,int $niveau, string $type,string $matiere): Response
    {
        $repository = $this->getDoctrine()->getRepository('App:Etudiant');
        $repository2 = $this->getDoctrine()->getRepository('App:Matiere');
        $etudiants=$repository->findAll();
        $mat=$repository2->findOneBy(['nom'=>$matiere]);
        $notes=array();

        foreach($etudiants as $etudiant){
            if($etudiant->getFiliere()->getFiliere()==$filiere && $etudiant->getNiveau()->getNiveau()==$niveau ){
                $note=new Note();
                $note->setAnneScolaire(2021);
                $note->setEtudiant($etudiant);
                $note->setMatiere($mat);


                array_push($notes,$note);

            }
        }


        /*$form = $this->createFormBuilder($note)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'enrigistrer'])
            ->getForm(); */


        return $this->render('scolarite/notes.html.twig', [
            'etudiants'=>$notes,
            'title' => 'Notes',
        ]);

    }



    #[Route('/scolarite/{semester}/{filiere}/{niveau}', name: 'matiere')]
    public function mats(Request $request,int $semester,string $filiere,int $niveau): Response
    {
        $repository = $this->getDoctrine()->getRepository('App:Filiere');
        $repository2 = $this->getDoctrine()->getRepository('App:MatiereNiveauFiliere');
        $repository3= $this->getDoctrine()->getRepository('App:Niveau');
        $filieres = $repository->findall();
        $niveaux = $repository3->findall();
        $matieres=$repository2->findall();

        foreach($filieres as $fil){
        if($fil->getFiliere()==$filiere){
            $filId=$fil->getId();
            break;
        }
        }

        foreach($niveaux as $niv){
            if($niv->getNiveau()==$niveau){
                $nivId=$niv->getId();
                break;
            }
        }

        foreach($matieres as $mat){
            $matName=$mat->getMatiere()->getNom();

            if($mat->getFiliere()->getId()==$filId && $mat->getNiveau()->getId()==$nivId){
                $matiere[$matName]=array();
                if($mat->getTp()){ array_push($matiere[$matName],"TP");}
                if($mat->getDs()){ array_push($matiere[$matName],"DS");}
                if($mat->getExamen()){ array_push($matiere[$matName],"Exam");}

            }
            else{$matiere=array();}
        }

        return $this->render('scolarite/matieres.html.twig', [
            'controller_name' => 'ScolariteController',
            'matiere'=>$matiere,
            'title' => 'Matieres',
        ]);
    }




}
