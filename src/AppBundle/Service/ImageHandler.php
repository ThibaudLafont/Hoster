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

    public function __construct(Uploader $uploader, Sluggifier $sluggifier)
    {
        $this->setUploader($uploader);
        $this->setSluggifier($sluggifier);
    }

    public function upload(string $name, string $alt, array $files)
    {
        // Define extension
        $ext = LocalImageExtension::getValue($files['type']);

        // Save Image
        $this->getUploader()->save($files['tmp_name'], $ext);

        // Entity creation
        return $this->createImage([
            'name' => $name,
            'slug' => $this->getSluggifier()->sluggify($name),
            'filename' => explode('/', $files['tmp_name'])[2],
            'extension' => $ext,
            'alt' => $alt,
            'dirPath' => '/uploads/medias/images/'
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

}