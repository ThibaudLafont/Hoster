<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ImageUpload extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction('/upload')
            ->add(
                'name',
                TextType::class
            )
            ->add(
                'alt',
                TextType::class
            )
            ->add(
                'image',
                FileType::class
            )
            ->add(
                'Uploader',
                SubmitType::class
            );
    }
}