<?php

namespace App\Form;


use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            # Champ TITREARTICLE
            ->add('titre', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control',
                    'placeholder'   =>  'Titre de l\'Article...'
                ]
            ])

            # Champ CATEGORIE
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'libelle',
                'expanded'  => false,
                'multiple'  => false,
                'label'     => false,
                'attr'          => [
                    'class'         =>  'form-control'
                ]
            ])

            # Champ CONTENUARTICLE
            ->add('contenu', TextareaType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control'
                ]
            ])

            # FEATUREDIMAGEARTICLE
            ->add('featuredimage', FileType::class, [
                'required'  => false,
                'label'     => false,
                'attr'      => [
                    'class' => 'dropify'
                ]
            ])

            # SPECIALARTICLE & SPOTLIGHTARTICLE
            ->add('special', CheckboxType::class, [
                'required'  => false,
                'label'     => false,
            ])
            ->add('spotlight', CheckboxType::class, [
                'required'  => false,
                'label'     => false,
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Publier',
                'attr'      => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Article::class,
        ));
    }

}