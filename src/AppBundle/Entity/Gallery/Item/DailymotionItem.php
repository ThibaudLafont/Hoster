<?php
namespace AppBundle\Entity\Gallery\Item;

use AppBundle\Entity\Distant\Dailymotion;
use AppBundle\Entity\Gallery\Gallery;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DailymotionItem
 * @package AppBundle\Entity\Gallery\Item
 *
 * @ORM\Entity()
 * @ORM\Table(name="gallery_item_dailymotion")
 */
class DailymotionItem extends GalleryItem
{

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(
     *     targetEntity="\AppBundle\Entity\Gallery\Gallery",
     *     inversedBy="dailymotionItems"
     * )
     */
    private $gallery;

    /**
     * @var Dailymotion
     *
     * @ORM\ManyToOne(
     *     targetEntity="\AppBundle\Entity\Distant\Dailymotion"
     * )
     */
    private $dailymotion;

    /**
     * @return Gallery
     */
    public function getGallery(): Gallery
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     */
    public function setGallery(Gallery $gallery): void
    {
        $this->gallery = $gallery;
    }

    /**
     * @return Dailymotion
     */
    public function getDailymotion(): Dailymotion
    {
        return $this->dailymotion;
    }

    /**
     * @param Dailymotion $dailymotion
     */
    public function setDailymotion(Dailymotion $dailymotion): void
    {
        $this->dailymotion = $dailymotion;
    }

}