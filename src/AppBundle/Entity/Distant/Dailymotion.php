<?php
namespace AppBundle\Entity\Distant;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Dailymotion
 * @package AppBundle\Entity\Distant
 *
 * @ORM\Entity()
 * @ORM\Table(name="media_distant_dailymotion")
 * @ORM\EntityListeners({"AppBundle\EventListener\ItemListener", "AppBundle\EventListener\DailymotionListener"})
 */
class Dailymotion extends Distant
{

    public function getThumbnail()
    {
        return 'https://www.dailymotion.com/thumbnail/video/' . $this->getCode();
    }

    public function getSrc()
    {
        return '//www.dailymotion.com/embed/video/' . $this->getCode();
    }

    public function getType()
    {
        return 'dailymotion';
    }

    /**
     * @return bool|int
     *
     * @Assert\IsTrue(message="L'url fournie ne dirige pas vers Dailymotion")
     */
    function isFromCorrectHost()
    {
        $return = strpos($this->getUrl(), 'dailymotion') > 0;
        if(!$return) $return = strpos($this->getUrl(), 'dai.ly') > 0;
        return $return;
    }

}