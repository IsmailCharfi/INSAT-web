<?php

namespace App\DataFixtures;
use App\Entity\Operateur;
use App\Service\UserManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UserFixture extends Fixture
{
    private $passwordEncoder;
    private $userManager;
    /**
     * UserFixtures constructor.
     */
    public function __construct(UserPasswordEncoderInterface $encoder, UserManager $userManager)
    {
        $this->passwordEncoder = $encoder;
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager)
    {
        $this->addOperateur('admin',[
            UserManager::ROLE_SCOLARITE,
            UserManager::ROLE_VALIDATEUR,
            UserManager::ROLE_EDITEUR_BASE,
            UserManager::ROLE_EDITEUR_SITE,
            ],$manager);
        $this->addOperateur('scolarite', [UserManager::ROLE_SCOLARITE],$manager);
        $this->addOperateur('validateur', [UserManager::ROLE_VALIDATEUR, UserManager::ROLE_SCOLARITE],$manager);
        $this->addOperateur('base', [UserManager::ROLE_EDITEUR_BASE, UserManager::ROLE_EDITEUR_SITE],$manager);
        $this->addOperateur('site', [UserManager::ROLE_EDITEUR_SITE],$manager);

    }

    public function addOperateur($name, array $roles,ObjectManager $manager)
    {
        $user = new Operateur();
        $user->setEmail($name."@insat.com");
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $name)
        );
        $user->setNom($name);
        $user->setPrenom($name);
        $user->setRoles($roles);
        $manager->persist($user);
        $manager->flush();
    }
}
