<?php

namespace App\Form;

use App\Entity\Carousel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CarouselType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'  => 'Titre',
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Image',
            ])
            ->add('link', TextType::class, [
                'label'  => 'Lien',
                'required' => false,
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carousel::class,
        ]);
    }
}
