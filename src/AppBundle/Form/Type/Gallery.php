<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Local\Image as ImageEntity;
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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Gallery extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Form build
        $builder
            ->add(
                'title',
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
            'data_class' => ImageEntity::class,
            'validation_groups' => function (FormInterface $form) {
                $data = $form->getData();

                if (is_null($data->getId())) {
                    return array('create');
                }

                return array('Default');
            }
        ]);
    }
}