<?php
namespace AppBundle\Entity\Gallery;

use AppBundle\Entity\Gallery\Item\DailymotionItem;
use AppBundle\Entity\Gallery\Item\ImageItem;
use AppBundle\Entity\Gallery\Item\VimeoItem;
use AppBundle\Entity\Gallery\Item\YoutubeItem;
use Doctrine\ORM\Mapping as ORM;

/**
use AppBundle\Form\Type\Gallery;
 * Class Gallery
 * @package AppBundle\Entity\Gallery
 *
 * @ORM\Entity()
 * @ORM\Table(name="gallery")
 */
class Gallery
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
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var YoutubeItem
     *
     * @ORM\OneToMany(
     *     targetEntity="\AppBundle\Entity\Gallery\Item\YoutubeItem",
     *     mappedBy="gallery"
     * )
     */
    private $youtubeItems;

    /**
     * @var DailymotionItem
     *
     * @ORM\OneToMany(
     *     targetEntity="\AppBundle\Entity\Gallery\Item\DailymotionItem",
     *     mappedBy="gallery"
     * )
     */
    private $dailymotionItems;

    /**
     * @var VimeoItem
     *
     * @ORM\OneToMany(
     *     targetEntity="\AppBundle\Entity\Gallery\Item\DailymotionItem",
     *     mappedBy="gallery"
     * )
     */
    private $vimeoItems;

    /**
     * @var ImageItem
     *
     * @ORM\OneToMany(
     *     targetEntity="\AppBundle\Entity\Gallery\Item\ImageItem",
     *     mappedBy="gallery"
     * )
     */
    private $imageItems;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return YoutubeItem
     */
    public function getYoutubeItems()
    {
        return $this->youtubeItems;
    }

    /**
     * @param $youtubeItems
     */
    public function setYoutubeItems($youtubeItems): void
    {
        $this->youtubeItems = $youtubeItems;
    }

    /**
     * @return DailymotionItem
     */
    public function getDailymotionItems()
    {
        return $this->dailymotionItems;
    }

    /**
     * @param $dailymotionItems
     */
    public function setDailymotionItems($dailymotionItems): void
    {
        $this->dailymotionItems = $dailymotionItems;
    }

    /**
     * @return VimeoItem
     */
    public function getVimeoItems()
    {
        return $this->vimeoItems;
    }

    /**
     * @param $vimeoItems
     */
    public function setVimeoItems($vimeoItems): void
    {
        $this->vimeoItems = $vimeoItems;
    }

    /**
     * @return ImageItem
     */
    public function getImageItems()
    {
        return $this->imageItems;
    }

    /**
     * @param $imageItems
     */
    public function setImageItems($imageItems): void
    {
        $this->imageItems = $imageItems;
    }

}