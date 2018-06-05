<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Gallery\Item\YoutubeItem;
use AppBundle\Entity\Gallery\Media;
use AppBundle\Entity\Item;
use AppBundle\EventSubscriber\GallerySubscriber;
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
    /**
     * @var MediaSerializer
     */
    private $mediaSerializer;

    /**
     * @var GallerySubscriber
     */
    private $gallerySubscriber;

    public function __construct(MediaSerializer $mediaSerializer, GallerySubscriber $gallerySubscriber)
    {
        $this->setMediaSerializer($mediaSerializer);
        $this->setGallerySubscriber($gallerySubscriber);
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
                'medias',
                EntityType::class,
                [
                    'class' => "AppBundle:Media",
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
            'data_class' => \AppBundle\Entity\Gallery\Gallery::class,
        ]);
    }

    /**
     * @return MediaSerializer
     */
    public function getMediaSerializer(): MediaSerializer
    {
        return $this->mediaSerializer;
    }

    /**
     * @param MediaSerializer $mediaSerializer
     */
    public function setMediaSerializer(MediaSerializer $mediaSerializer): void
    {
        $this->mediaSerializer = $mediaSerializer;
    }

    /**
     * @return GallerySubscriber
     */
    public function getGallerySubscriber(): GallerySubscriber
    {
        return $this->gallerySubscriber;
    }

    /**
     * @param GallerySubscriber $gallerySubscriber
     */
    public function setGallerySubscriber(GallerySubscriber $gallerySubscriber): void
    {
        $this->gallerySubscriber = $gallerySubscriber;
    }
}