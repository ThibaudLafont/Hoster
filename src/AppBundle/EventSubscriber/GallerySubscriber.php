<?php
namespace AppBundle\EventSubscriber;

use AppBundle\Entity\Distant\Dailymotion;
use AppBundle\Entity\Distant\Vimeo;
use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Gallery\Item;
use AppBundle\Entity\Gallery\Media;
use AppBundle\Entity\Local\Image;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GallerySubscriber implements EventSubscriberInterface
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em) {
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

        // Add items to gallery
        foreach($data->getNewItems() as $newItem) {
            $entity = $this->getEm()->getRepository(\AppBundle\Entity\Media::class)
                ->find($newItem['id']);
            $this->createNewItem($entity, $data, $newItem['position']);
//            switch ($newItem['type']){
//                case 'image':
//                    $image = $this->getEm()->getRepository(Image::class)
//                        ->find($newItem['id']);
//                    $this->createNewItem($image, $data, $newItem['position']);
//                case 'youtube':
//                    $yt = $this->getEm()->getRepository(Youtube::class)
//                        ->find($newItem['id']);
//                    $this->createNewItem($yt, $data, $newItem['position']);
//                case 'dailymotion':
//                    $dm = $this->getEm()->getRepository(Dailymotion::class)
//                        ->find($newItem['id']);
//                    $this->createNewItem($dm, $data, $newItem['position']);
//                case 'vimeo':
//                    $vm = $this->getEm()->getRepository(Vimeo::class)
//                        ->find($newItem['id']);
//                    $this->createNewItem($vm, $data, $newItem['position']);
//            }
        }

    }

    private function createNewItem($entity, $gallery, $position)
    {
        $item = new Item();
        $item->setMedia($entity);
        $item->setPosition($position);
        $gallery->addItem($item);
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
}
