<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Item;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * @package AppBundle\EventListener
 */
class DailymotionListener
{
    /**
     * @param $vid
     */
    public function prePersist(Youtube $vid)
    {
        // Extract code & assign to entity
        $vid->setCode(
            $this->extractCodeFromUrl($vid->getUrl())
        );
    }

    /**
     * @param Youtube $vid
     * @param PreUpdateEventArgs $event
     */
    public function preUpdate(Youtube $vid, PreUpdateEventArgs $event)
    {
        if($event->hasChangedField('url')) {
            // Extract code & assign to entity
            $vid->setCode(
                $this->extractCodeFromUrl($vid->getUrl())
            );
        }
    }

    private function extractCodeFromUrl(string $url)
    {
        // Preg match
        preg_match(
            '%(?:dailymotion\.com\/|dai\.ly)(?:video|hub)?\/([0-9a-z]+)%',
            $url,
            $match
        );
        return $match[1];
    }
}
