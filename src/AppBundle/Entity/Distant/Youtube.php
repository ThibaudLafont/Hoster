<?php
namespace AppBundle\Entity\Distant;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Youtube
 * @package AppBundle\Entity\Distant
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_distant_youtube")
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener", "AppBundle\EventListener\YoutubeListener"})
 */
class Youtube extends Distant
{

    public function getThumbnail()
    {
        return 'https://img.youtube.com/vi/' .
            $this->getCode() .
            '/hqdefault.jpg';
    }

    public function getSrc()
    {
        return 'https://www.youtube.com/embed/' . $this->getCode();
    }

    public function getType()
    {
        return 'youtube';
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