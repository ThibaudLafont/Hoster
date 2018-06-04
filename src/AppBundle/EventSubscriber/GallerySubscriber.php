<?php
namespace AppBundle\EventSubscriber;

use AppBundle\Entity\Distant\Dailymotion;
use AppBundle\Entity\Distant\Vimeo;
use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Gallery\Gallery;
use AppBundle\Entity\Gallery\Item\DailymotionItem;
use AppBundle\Entity\Gallery\Item\ImageItem;
use AppBundle\Entity\Gallery\Item\VimeoItem;
use AppBundle\Entity\Gallery\Item\YoutubeItem;
use AppBundle\Entity\Gallery\Media;
use AppBundle\Entity\Local\Image;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GallerySubscriber implements EventSubscriberInterface
{
    /**
     * @var Gallery
     */
    private $gallery;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->setEm($em);
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SUBMIT => 'convertMediaEntities'
        ];
    }

    public function convertMediaEntities(FormEvent $event)
    {
        // Get data
        $data = $event->getData();
        // Store gallery
        $this->setGallery($data);

        // Loop on every media
        foreach($data->getMedias() as $media) {
            switch ($media->getType()) {
                case 'youtube':
                    $this->handleYoutube($media);
                    break;
                case 'dailymotion':
                    $this->handleDailymotion($media);
                    break;
                case 'vimeo':
                    $this->handleVimeo($media);
                    break;
                case 'image':
                    $this->handleImage($media);
                    break;
            }
        }

        // Erase medias
        $this->getGallery()->setMedias(null);

        // Set new data to event
        $event->setData($this->getGallery());
    }

    private function handleYoutube(Media $media)
    {
        // Get Youtube media
        $yt = $this->getEm()->getRepository(Youtube::class)
            ->find($media->getId());

        // Create new YtItem
        $ytItem = new YoutubeItem();
        $ytItem->setYoutube($yt);

        // Add YtItem to gallery
        $this->getGallery()->addYoutubeItem($ytItem);
    }

    private function handleDailymotion(Media $media)
    {
        $dm = $this->getEm()->getRepository(Dailymotion::class)
            ->find($media->getId());

        // Create new YtItem
        $dmItem = new DailymotionItem();
        $dmItem->setDailymotion($dm);

        // Add YtItem to gallery
        $this->getGallery()->addDailymotionItem($dmItem);
    }

    private function handleVimeo(Media $media)
    {
        $vm = $this->getEm()->getRepository(Vimeo::class)
            ->find($media->getId());

        // Create new YtItem
        $vmItem = new VimeoItem();
        $vmItem->setVimeo($vm);

        // Add YtItem to gallery
        $this->getGallery()->addVimeoItem($vmItem);
    }


    private function handleImage(Media $media)
    {
        $im = $this->getEm()->getRepository(Image::class)
            ->find($media->getId());

        // Create new YtItem
        $imItem = new ImageItem();
        $imItem->setImage($im);

        // Add YtItem to gallery
        $this->getGallery()->addImageItem($imItem);
    }


    /**
     * @return ObjectManager
     */
    public function getEm(): ObjectManager
    {
        return $this->em;
    }

    /**
     * @param ObjectManager $em
     */
    public function setEm(ObjectManager $em): void
    {
        $this->em = $em;
    }

    /**
     * @return Gallery
     */
    public function getGallery(): Gallery
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     */
    public function setGallery(Gallery $gallery): void
    {
        $this->gallery = $gallery;
    }
}
