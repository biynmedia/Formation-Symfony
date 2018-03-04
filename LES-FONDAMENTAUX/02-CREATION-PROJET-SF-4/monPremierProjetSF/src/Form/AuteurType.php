<?php

namespace App\Form;


use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            # Champ prenom
            ->add('prenom', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control',
                    'placeholder'   =>  'Saisissez votre Prénom'
                ]
            ])

            # Champ nom
            ->add('nom', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control',
                    'placeholder'   =>  'Saisissez votre Nom'
                ]
            ])

            # Champ email
            ->add('email', EmailType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control',
                    'placeholder'   =>  'Saisissez votre Email'
                ]
            ])

            # Champ mot de passe
            ->add('password', PasswordType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control',
                    'placeholder'   =>  '*******'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'M\'inscrire !',
                'attr'      => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Auteur::class,
        ));
    }
}