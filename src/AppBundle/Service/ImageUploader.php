<?php
namespace AppBundle\Service;

use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class ImageUploader
{
    /**
     * @var ImageManager
     */
    private $manager;

    /**
     * @var string
     */
    private $rootImageDir;

    /**
     * Uploader constructor.
     * @param ImageManager $manager
     * @param string $rootUploadDir
     */
    public function __construct(ImageManager $manager, string $rootUploadDir)
    {
        $this->setManager($manager);
        $this->setRootImageDir($rootUploadDir);
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
            $this->getRootImageDir()
        );

        // Save Thumbnail
        $this->saveImage(
            $image,
            $slug,
            $ext,
            250,
            $this->getRootImageDir() . 'thumbnails/'
        );

        // Destroy image
        $image->destroy();
    }

    public function rename(string $oldFilename, string $newFilename)
    {
        // Rename main image
        rename(
            $this->getRootImageDir() . $oldFilename,
            $this->getRootImageDir() . $newFilename
        );

        // Rename thumbnail
        rename(
            $this->getRootImageDir() . 'thumbnails/' . $oldFilename,
            $this->getRootImageDir() . 'thumbnails/' . $newFilename
        );
    }

    public function delete(string $filename)
    {
        // Delete original pic
        if(file_exists($this->getRootImageDir() . $filename)) {
            unlink($this->getRootImageDir() . $filename);
        }

        // Delete thumbnail
        if(file_exists($this->getRootImageDir() . 'thumbnails/' . $filename)) {
            unlink($this->getRootImageDir() . 'thumbnails/' . $filename);
        }
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

    /**
     * @return string
     */
    public function getRootImageDir(): string
    {
        return $this->rootImageDir;
    }

    /**
     * @param string $rootImageDir
     */
    public function setRootImageDir(string $rootImageDir): void
    {
        $this->rootImageDir = $rootImageDir;
    }

}