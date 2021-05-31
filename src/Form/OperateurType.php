<?php

namespace App\Form;

use App\Entity\Operateur;
use App\Service\UserManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('roles', ChoiceType::class,[
                'choices' => [
                    UserManager::ROLE_ADMIN => 0,
                    UserManager::ROLE_EDITEUR_BASE => 1,
                    UserManager::ROLE_EDITEUR_SITE => 2,
                    UserManager::ROLE_VALIDATEUR => 3,
                    UserManager::ROLE_SCOLARITE => 4,
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('password')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Operateur::class,
        ]);
    }
}
