<?php
namespace AppBundle\EventSubscriber;

use AppBundle\Entity\Gallery\Item;
use AppBundle\Entity\Gallery\Media;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GallerySubscriber implements EventSubscriberInterface
{

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

//        $i = 1;

//        foreach($data->getMedias() as $media) {
//
//            $item = new Item();
//            $item->setMedia($media);
//            $item->setPosition($i);
//
//            $data->addItem($item);
//
//            $i++;
//
//        }

        $i = 1;
        foreach($data->getItems() as $item) {
            $data->addItem($item);
            $item->setPosition($i);
            $i++;
        }

    }
}
