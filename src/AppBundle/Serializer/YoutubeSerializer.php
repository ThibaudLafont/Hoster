<?php
namespace AppBundle\Serializer;

use AppBundle\Entity\Distant\Youtube;
use Doctrine\Common\Persistence\ObjectManager;

class YoutubeSerializer extends Serializer
{
    protected function getEntities()
    {
        return $this->getEm()->getRepository(Youtube::class)
            ->findAll();
    }

    protected function getEntity(int $id)
    {
        return $this->getEm()->getRepository(Youtube::class)
            ->find($id);
    }

    protected function normalizeEntity(Youtube $entity)
    {
        return [
            'type' => 'youtube',
            'id'   => $entity->getId(),
            'name' => $entity->getName(),
            'thumbnail'  => $entity->getCoverImage()
        ];
    }
}