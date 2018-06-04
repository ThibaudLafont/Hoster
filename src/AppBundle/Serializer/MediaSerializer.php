<?php
namespace AppBundle\Serializer;

use AppBundle\Entity\Gallery\Media;

class MediaSerializer
{
    /**
     * @var DailymotionSerializer
     */
    private $dailymotion;

    /**
     * @var YoutubeSerializer
     */
    private $youtube;

    /**
     * @var VimeoSerializer
     */
    private $vimeo;

    /**
     * @var ImageSerializer
     */
    private $image;

    public function __construct(
        DailymotionSerializer $dailymotion,
        YoutubeSerializer $youtube,
        VimeoSerializer $vimeo,
        ImageSerializer $image
    )
    {
        $this->setDailymotion($dailymotion);
        $this->setYoutube($youtube);
        $this->setVimeo($vimeo);
        $this->setImage($image);
    }

    public function normalizeAllMedias()
    {
        // Init empty array
        $return = [];

        // Merge all norm of differents medias
        $return = array_merge($return, $this->getYoutube()->normalizeAll());
        $return = array_merge($return, $this->getDailymotion()->normalizeAll());
        $return = array_merge($return, $this->getVimeo()->normalizeAll());
        $return = array_merge($return, $this->getImage()->normalizeAll());

        return $return;
    }

    public function getMediaEntities()
    {
        $return = [];

        foreach($this->normalizeAllMedias() as $data) {
            $entity = new Media();
            $entity->hydrate($data);
            $return[] = $entity;
        }

        return $return;
    }

    /**
     * @return DailymotionSerializer
     */
    public function getDailymotion(): DailymotionSerializer
    {
        return $this->dailymotion;
    }

    /**
     * @param DailymotionSerializer $dailymotion
     */
    public function setDailymotion(DailymotionSerializer $dailymotion): void
    {
        $this->dailymotion = $dailymotion;
    }

    /**
     * @return YoutubeSerializer
     */
    public function getYoutube(): YoutubeSerializer
    {
        return $this->youtube;
    }

    /**
     * @param YoutubeSerializer $youtube
     */
    public function setYoutube(YoutubeSerializer $youtube): void
    {
        $this->youtube = $youtube;
    }

    /**
     * @return VimeoSerializer
     */
    public function getVimeo(): VimeoSerializer
    {
        return $this->vimeo;
    }

    /**
     * @param VimeoSerializer $vimeo
     */
    public function setVimeo(VimeoSerializer $vimeo): void
    {
        $this->vimeo = $vimeo;
    }

    /**
     * @return ImageSerializer
     */
    public function getImage(): ImageSerializer
    {
        return $this->image;
    }

    /**
     * @param ImageSerializer $image
     */
    public function setImage(ImageSerializer $image): void
    {
        $this->image = $image;
    }

}