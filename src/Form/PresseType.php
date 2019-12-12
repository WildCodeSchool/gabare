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
            ->add('video')
            ->add('image')
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('resume', TextareaType::class, [
                'label' => 'Résumé',
            ])
            ->add('link', UrlType::class, [
                'label' => 'Lien',
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
