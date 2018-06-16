<?php
namespace AppBundle\Form\Type;

use AppBundle\EventSubscriber\DistantSubscriber;
use AppBundle\EventSubscriber\MediaSubscriber;
use AppBundle\Service\Slugifier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
            ->addEventSubscriber(new DistantSubscriber())
            ->addEventSubscriber(new MediaSubscriber(new Slugifier()))
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
            )
            ->add(
                'slug',
                HiddenType::class
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}