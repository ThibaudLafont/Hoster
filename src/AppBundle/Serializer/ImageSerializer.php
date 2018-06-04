<?php
namespace AppBundle\Serializer;

use AppBundle\Entity\Local\Image;

class ImageSerializer extends Serializer
{
    protected function getEntities()
    {
        return $this->getEm()->getRepository(Image::class)
            ->findAll();
    }

    protected function getEntity(int $id)
    {
        return $this->getEm()->getRepository(Image::class)
            ->find($id);
    }

    protected function normalizeEntity(Image $entity)
    {
        return [
            'type' => 'image',
            'id'   => $entity->getId(),
            'name' => $entity->getName(),
            'thumbnail'  => $entity->getThumbSrc()
        ];
    }
}