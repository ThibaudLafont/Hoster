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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            FormEvents::POST_SUBMIT => 'convertMediaEntities',
            FormEvents::PRE_SET_DATA => 'handleFormBuild'
        ];
    }

    public function convertMediaEntities(FormEvent $event)
    {
        // Get data
        $data = $event->getData();

        // Add items to gallery
        if(!is_null($data->getNewItems())) {
            foreach($data->getNewItems() as $newItem) {
                $entity = $this->getEm()->getRepository(\AppBundle\Entity\Media::class)
                    ->find($newItem['id']);
                $this->createNewItem($entity, $data, $newItem['position']);
            }
        }

    }

    public function handleFormBuild(FormEvent $event)
    {
        // Get data
        $form = $event->getForm();
        $data = $event->getData();

        // If no data ; gallery_add
        if(is_null($data->getTitle())) {
            $form
                ->add(
                    'submit',
                    SubmitType::class, [
                        'label' => 'Créer la galerie'
                    ]
                );
            // Else, gallery_edit
        } else {
            $form
                ->add(
                    'submit',
                    SubmitType::class, [
                        'label' => 'Mettre à jour'
                    ]
                );
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
