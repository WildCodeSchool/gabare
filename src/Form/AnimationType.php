<?php

namespace App\Form;

use App\Entity\Animation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('description')
            ->add('schedule', DateType::class, [
                'label' => 'Date',
                'format' => 'ddMMMMyyyy',
                'choice_translation_domain' => true,
            ])
            ->add('hourStart', TimeType::class, [
                'label' => 'Heure de début',
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('hourEnd', TimeType::class, [
                'label' => 'Heure de fin',
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animation::class,
        ]);
    }
}
