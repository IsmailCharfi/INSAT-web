<?php

namespace App\Controller;

use App\Entity\Parametres;
use App\Form\ParametresType;
use App\Repository\ParametresRepository;
use App\Service\AppDataManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/parametres')]
class ParametresController extends AbstractController
{

    #[Route('/edit', name: 'parametres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AppDataManager $appDataManager): Response
    {
        $parametres = $this->getDoctrine()->getRepository(Parametres::class)->findCurrentParameters();
        $form = $this->createForm(ParametresType::class, $parametres);
        $form->handleRequest($request);
        $showForm = true;

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parametres);
            $entityManager->flush();

            $this->addFlash('success',"Paramètres modifiés avec succès" );

            try
            {
                $this->appDataManager->reloadData();
            }catch (\Exception $exception){}

            $showForm = false;
            return $this->show($parametres);

        }
            return $this->render('parametres/edit.html.twig', [
                'parametre' => $parametres,
                'form' => $form->createView(),
                'title' => 'Modifier un paramètre',
                'showForm' => $showForm,
            ]);
    }

    #[Route('/{id}', name: 'parametres_show', methods: ['POST'])]
    public function show(Parametres $parametres): Response
    {
        return $this->render('parametres/show.html.twig', [
            'parametres' => $parametres,
            'title' => 'Paramétres du site',
        ]);
    }
}
