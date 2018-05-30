<?php
namespace AppBundle\Service;

use Intervention\Image\Image;
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
     * @param string $imgPath
     * @param string $slug
     * @param string $ext
     */
    public function save(string $imgPath, string $slug, string $ext)
    {
        // Make Image
        $manager = $this->getManager();
        $image = $manager->make($imgPath);

        // Save Image in 1600
        $this->saveImage(
            $image,
            $slug,
            $ext,
            1600,
            '/var/www/html/web/uploads/medias/images/'
        );

        // Save Thumbnail
        $this->saveImage(
            $image,
            $slug,
            $ext,
            250,
            '/var/www/html/web/uploads/medias/images/thumbnails/'
        );

        $image->destroy();
    }

    private function saveImage(Image $image, string $name, string $ext, int $width, string $dirPath)
    {
        $image
            ->interlace(true)
            ->resize(
                $width, null,
                function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                }
            )
            ->save($dirPath
                . $name
                . '.' . $ext
            )
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