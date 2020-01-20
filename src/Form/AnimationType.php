<?php

namespace App\Form;

use App\Entity\Animation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Image',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animation::class,
        ]);
    }
}
