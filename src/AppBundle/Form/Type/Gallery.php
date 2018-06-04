<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Gallery\Item\YoutubeItem;
use AppBundle\Entity\Gallery\Media;
use AppBundle\Entity\Item;
use AppBundle\Serializer\MediaSerializer;
use AppBundle\Serializer\YoutubeSerializer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Gallery extends AbstractType
{

    private $youtube;

    public function __construct(MediaSerializer $youtube)
    {
        $this->setYoutube($youtube);
    }

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
                ChoiceType::class,
                [
                    'choices' => $this->getYoutube()->getMediaEntities(),
                    'choice_label' => function($media, $key, $value) {
                        /** @var Category $category */
                        return $media->getName();
                    },
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

    /**
     * @return mixed
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * @param mixed $youtube
     */
    public function setYoutube($youtube): void
    {
        $this->youtube = $youtube;
    }
}