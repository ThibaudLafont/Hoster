<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Youtube extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction('/add/youtube')
            ->add(
                'name',
                TextType::class
            )
            ->add(
                'alt',
                TextType::class
            )
            ->add(
                'src',
                TextType::class
            )
            ->add(
                'Ajouter',
                SubmitType::class
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}