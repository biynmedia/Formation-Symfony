<?php
/**
 * Created by PhpStorm.
 * User: Hugo LIEGEARD
 * Date: 02/03/2018
 * Time: 01:22
 */

namespace App\Form;


use App\Entity\Newsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            # Champ EMAIL
            ->add('email', EmailType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control',
                    'placeholder'   =>  'Votre email...'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Je m\'inscris !',
                'attr'      => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Newsletter::class,
        ));
    }
}