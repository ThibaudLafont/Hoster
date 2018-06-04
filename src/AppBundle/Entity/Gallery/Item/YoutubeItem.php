<?php
namespace AppBundle\Entity\Gallery\Item;

use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Gallery\Gallery;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class YoutubeItem
 * @package AppBundle\Entity\Gallery\Item
 *
 * @ORM\Entity()
 * @ORM\Table(name="gallery_item_youtube")
 */
class YoutubeItem extends GalleryItem
{

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(
     *     targetEntity="\AppBundle\Entity\Gallery\Gallery",
     *     inversedBy="youtubeItems"
     * )
     */
    private $gallery;

    /**
     * @var Youtube
     *
     * @ORM\ManyToOne(
     *     targetEntity="\AppBundle\Entity\Distant\Youtube"
     * )
     */
    private $youtube;

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
     * @return Youtube
     */
    public function getYoutube(): Youtube
    {
        return $this->youtube;
    }

    /**
     * @param Youtube $youtube
     */
    public function setYoutube(Youtube $youtube): void
    {
        $this->youtube = $youtube;
    }

}