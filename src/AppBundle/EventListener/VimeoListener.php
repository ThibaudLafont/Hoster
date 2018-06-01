<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Distant\Vimeo;
use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Item;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Class ItemListener
 *
 * @package AppBundle\EventListener
 */
class VimeoListener
{
    /**
     * @param $vid
     */
    public function prePersist(Vimeo $vid)
    {
        // Extract code & assign to entity
        $vid->setCode(
            $this->extractCodeFromUrl($vid->getUrl())
        );
        // Get thumbnailUrl
        $vid->setCoverUrl(
            $this->requestCoverUrl($vid->getCode())
        );
    }

    /**
     * @param Vimeo $vid
     * @param PreUpdateEventArgs $event
     */
    public function preUpdate(Vimeo $vid, PreUpdateEventArgs $event)
    {
        if($event->hasChangedField('url')) {
            // Extract code & assign to entity
            $vid->setCode(
                $this->extractCodeFromUrl($vid->getUrl())
            );
            // Get thumbnailUrl
            $vid->setCoverUrl(
                $this->requestCoverUrl($vid->getCode())
            );
        }
    }

    private function requestCoverUrl(int $code)
    {
        $json = unserialize(file_get_contents("http://vimeo.com/api/v2/video/{$code}.php"));

        return $json[0]['thumbnail_large'];
    }

    private function extractCodeFromUrl(string $url)
    {
        // Preg match
        preg_match(
            '%(http|https)?:\/\/(www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|)(\d+)(?:|\/\?)%',
            $url,
            $match
        );
        return $match[4];
    }
}
