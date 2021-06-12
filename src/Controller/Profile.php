<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Profile extends AbstractController
{
    /**
     * @Route ("/profile", name="profil")
     */
    public function profil(): Response
    {
        return $this->render('profile.html.twig', [
            'title' => 'USER',
        ]);
    }

}