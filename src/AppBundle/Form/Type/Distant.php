<?php
namespace AppBundle\Form\Type;

use AppBundle\EventSubscriber\YoutubeSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Distant extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber(new YoutubeSubscriber())
            ->add(
                'name',
                TextType::class, [
                    'label' => 'Nom'
                ]
            )
            ->add(
                'url',
                TextType::class, [
                    'label' => 'URL'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}