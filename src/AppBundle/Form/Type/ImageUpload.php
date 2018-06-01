<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Local\Image;
use AppBundle\EventSubscriber\ImageSubscriber;
use AppBundle\Service\Slugifier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageUpload extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Form build
        $builder
            ->addEventSubscriber(new ImageSubscriber(new Slugifier()))
            ->add(
                'name',
                TextType::class
            )
            ->add(
                'alt',
                TextType::class
            )
            ->add(
                'slug',
                HiddenType::class
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class
        ]);
    }
}