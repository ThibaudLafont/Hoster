<?php
namespace AppBundle\Entity\Gallery;

use AppBundle\Entity\Gallery\Item\DailymotionItem;
use AppBundle\Entity\Gallery\Item\VimeoItem;
use AppBundle\Entity\Gallery\Item\YoutubeItem;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @var VimeoItem
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
     * @return YoutubeItem
     */
    public function getYoutubeItems(): YoutubeItem
    {
        return $this->youtubeItems;
    }

    /**
     * @param YoutubeItem $youtubeItems
     */
    public function setYoutubeItems(YoutubeItem $youtubeItems): void
    {
        $this->youtubeItems = $youtubeItems;
    }

    /**
     * @return DailymotionItem
     */
    public function getDailymotionItems(): DailymotionItem
    {
        return $this->dailymotionItems;
    }

    /**
     * @param DailymotionItem $dailymotionItems
     */
    public function setDailymotionItems(DailymotionItem $dailymotionItems): void
    {
        $this->dailymotionItems = $dailymotionItems;
    }

    /**
     * @return VimeoItem
     */
    public function getVimeoItems(): VimeoItem
    {
        return $this->vimeoItems;
    }

    /**
     * @param VimeoItem $vimeoItems
     */
    public function setVimeoItems(VimeoItem $vimeoItems): void
    {
        $this->vimeoItems = $vimeoItems;
    }

}