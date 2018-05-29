<?php
namespace AppBundle\Service;

use Intervention\Image\ImageManager;

class Uploader
{
    /**
     * @var ImageManager
     */
    private $manager;

    /**
     * Uploader constructor.
     * @param ImageManager $manager
     */
    public function __construct(ImageManager $manager)
    {
        $this->setManager($manager);
    }

    /**
     * Save new image
     * @param mixed  $img
     * @param string $ext
     */
    public function save($img, $ext)
    {
        // Make Image
        $manager = $this->getManager();
        $image = $manager->make($img);

        // Save Image
        $image
            ->interlace(true)
            ->save('/var/www/html/web/uploads/medias/images/'
                . $image->filename
                . '.' . $ext)
        ;
    }

    /**
     * @return ImageManager
     */
    public function getManager() : ImageManager
    {
        return $this->manager;
    }

    /**
     * @param ImageManager $manager
     */
    public function setManager(ImageManager $manager)
    {
        $this->manager = $manager;
    }

}