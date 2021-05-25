<?php

namespace App\DataFixtures;
use App\Entity\Operateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UserFixture extends Fixture
{
    private $passwordEncoder;
    /**
     * UserFixtures constructor.
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->passwordEncoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
       for($i=1;$i<5;$i++)
       { $user = new Operateur();
          $user->setEmail("admin$i@insat.u-carthage.tn");
          $user->setPassword(
              $this->passwordEncoder->encodePassword($user, 'admin')
          );
          $user->setNom("admin$i");
          $user->setPrenom("admin$i");
          $manager->persist($user);
       }
        $manager->flush();
    }
}
