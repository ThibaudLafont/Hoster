<?php
namespace AppBundle\Entity\Gallery;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Item
 * @package AppBundle\Entity\Gallery
 *
 * @ORM\Entity()
 * @ORM\Table(name="gallery_item")
 */
class Item
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(
     *     targetEntity="Gallery"
     * )
     */
    private $gallery;

    /**
     * @var \AppBundle\Entity\Media
     *
     * @ORM\ManyToOne(
     *     targetEntity="\AppBundle\Entity\Media"
     * )
     */
    private $media;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Gallery
     */
    public function getGallery()
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
     * @return \AppBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param \AppBundle\Entity\Media $media
     */
    public function setMedia(\AppBundle\Entity\Media $media): void
    {
        $this->media = $media;
        $media->addItem($this);
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

}