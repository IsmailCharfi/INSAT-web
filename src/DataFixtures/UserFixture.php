<?php

namespace App\DataFixtures;
use App\Entity\Operateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
       for($i=1;$i<5;$i++)
       { $user = new Operateur();
          $user->setEmail("admin$i@insat.u-carthage.tn");
          $user->setPassword("admin");
          $user->setNom("admin$i");
          $user->setPrenom("admin$i");
          $manager->persist($user);
       }
        $manager->flush();
    }
}
