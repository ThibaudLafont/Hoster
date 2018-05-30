<?php
namespace AppBundle\Service;

use AppBundle\Entity\Local\Image;
use AppBundle\Enumeration\Entity\LocalImageExtension;

class ImageHandler
{
    /**
     * @var Uploader
     */
    private $uploader;

    /**
     * @var Sluggifier
     */
    private $sluggifier;

    /**
     * @var string
     */
    private $imageDir;

    public function __construct(
        Uploader $uploader,
        Sluggifier $sluggifier,
        string $webUploadDir
    )
    {
        $this->setUploader($uploader);
        $this->setSluggifier($sluggifier);
        $this->setImageDir($webUploadDir);
    }

    public function upload(string $name, string $alt, array $files)
    {
        // Define extension
        $ext = LocalImageExtension::getValue($files['type']['image']);
        // Define Slug
        $slug = $this->getSluggifier()->sluggify($name);

        // Save Image
        $this->getUploader()->save(
            $files['tmp_name']['image'], $slug, $ext
        );

        // Entity creation
        return $this->createImage([
            'name' => $name,
            'slug' => $slug,
            'filename' => explode('/', $files['tmp_name']['image'])[2],
            'extension' => $ext,
            'alt' => $alt,
            'dirPath' => $this->getImageDir()
        ]);
    }

    private function createImage(array $data)
    {
        $entity = new Image();
        $entity->hydrate($data);
        return $entity;
    }

    /**
     * @return Uploader
     */
    public function getUploader(): Uploader
    {
        return $this->uploader;
    }

    /**
     * @param Uploader $uploader
     */
    public function setUploader(Uploader $uploader): void
    {
        $this->uploader = $uploader;
    }

    /**
     * @return Sluggifier
     */
    public function getSluggifier(): Sluggifier
    {
        return $this->sluggifier;
    }

    /**
     * @param Sluggifier $sluggifier
     */
    public function setSluggifier(Sluggifier $sluggifier): void
    {
        $this->sluggifier = $sluggifier;
    }

    /**
     * @return string
     */
    public function getImageDir(): string
    {
        return $this->imageDir;
    }

    /**
     * @param string $imageDir
     */
    public function setImageDir(string $imageDir): void
    {
        $this->imageDir = $imageDir;
    }

}