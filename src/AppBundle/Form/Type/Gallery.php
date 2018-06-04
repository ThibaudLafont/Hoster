<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Gallery\Item\YoutubeItem;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
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
                'youtubeItems',
                EntityType::class,
                [
                    'class' => Youtube::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true
                ]
            )
            ->add(
                'Créer',
                SubmitType::class
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}