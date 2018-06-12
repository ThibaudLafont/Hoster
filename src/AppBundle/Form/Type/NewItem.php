<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewItem extends AbstractType
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
                'id', TextType::class, [
                    'attr' => [
                        'class' => 'newitem-id'
                    ]
                ]
            )
            ->add(
                'type', TextType::class, [
                    'attr' => [
                        'class' => 'newitem-type'
                    ]
                ]
            )
            ->add(
                'position', TextType::class, [
                    'attr' => [
                        'class' => 'item-position'
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}