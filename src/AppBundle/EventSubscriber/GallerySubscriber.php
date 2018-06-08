<?php
namespace AppBundle\EventSubscriber;

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
            switch ($newItem['type']){
                case 'image':
                    $image = $this->getEm()->getRepository(Image::class)
                        ->find($newItem['id']);
                    $item = new Item();
                    $item->setMedia($image);
                    $item->setPosition($newItem['position']);
                    $data->addItem($item);
            }
        }

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
