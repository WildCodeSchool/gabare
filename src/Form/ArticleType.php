<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])

            ->add('description', CKEditorType::class, [
                'label' => "Description",
                'trim' => true,
            ])

            ->add('imageFile', VichImageType::class, [
            'required' => true,
            'allow_delete' => false,
            'download_uri' => false,
            'image_uri' => true,
            'asset_helper' => true,
            'label' => 'Image',
                ])

            ->add('date', DateType::class, [
                'label' => 'Date de publication',
                'format' => 'ddMMMMyyyy',
                'choice_translation_domain' => true,
            ])
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'name',
                'label' => 'Thème',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
