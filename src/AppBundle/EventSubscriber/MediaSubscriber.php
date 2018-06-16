<?php
namespace AppBundle\EventSubscriber;

use AppBundle\Service\Slugifier;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MediaSubscriber implements EventSubscriberInterface
{
    /**
     * @var Sluggifier
     */
    private $slugifier;

    public function __construct(Slugifier $sluggifier)
    {
        $this->setSlugifier($sluggifier);
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => 'slugifyImageName'
        ];
    }

    public function slugifyImageName(FormEvent $event)
    {
        // Get data
        $media = $event->getData();

        // Generate&Assign slugName
        $media['slug'] = $this->getSlugifier()->slugify($media['name']);

        // Set datas to event
        $event->setData($media);
    }

    /**
     * Get Slugifier
     *
     * @return Slugifier
     */
    public function getSlugifier(): Slugifier
    {
        return $this->slugifier;
    }

    /**
     * Set Slugifier
     *
     * @param Slugifier $slugifier
     */
    public function setSlugifier(Slugifier $slugifier)
    {
        $this->slugifier = $slugifier;
    }
}
