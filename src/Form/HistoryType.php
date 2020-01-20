<?php

namespace App\Form;

use App\Entity\History;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Sous-Titre',
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Description',
                'trim' => true,
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
            'data_class' => History::class,
        ]);
    }
}
