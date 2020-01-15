<?php

namespace App\Form;

use App\Entity\Presse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('video', TextType::class, [
                'label' => 'Lien de la vidéo',
                ])
            ->add('image', UrlType::class, [
                'label' => 'Lien de l\'image de l\'article',
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'article',
            ])
            ->add('resume', TextareaType::class, [
                'label' => 'Résumé de l\'article',
            ])
            ->add('link', UrlType::class, [
                'label' => 'Lien de l\'article',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presse::class,
        ]);
    }
}
