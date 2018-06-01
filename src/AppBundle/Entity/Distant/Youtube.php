<?php
namespace AppBundle\Entity\Distant;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Youtube
 * @package AppBundle\Entity\Distant
 *
 * @ORM\Entity()
 * @ORM\Table(name="distant_youtube")
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener", "AppBundle\EventListener\YoutubeListener"})
 */
class Youtube extends Distant
{

    public function getCoverImage()
    {
        return 'https://img.youtube.com/vi/' .
            $this->getCode() .
            '/hqdefault.jpg';
    }

    public function getEmbedSrc()
    {
        return 'https://www.youtube.com/embed/' . $this->getCode();
    }

    /**
     * @return bool|int
     *
     * @Assert\IsTrue(message="L'url fournie ne dirige pas vers Youtube")
     */
    function isFromCorrectHost()
    {
        $return = strpos($this->getUrl(), 'youtube') > 0;
        if(!$return) $return = strpos($this->getUrl(), 'youtu.be') > 0;
        return $return;
    }
}