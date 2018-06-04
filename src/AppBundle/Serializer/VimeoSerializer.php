<?php
namespace AppBundle\Serializer;

use AppBundle\Entity\Distant\Vimeo;

class VimeoSerializer extends Serializer
{
    protected function getEntities()
    {
        return $this->getEm()->getRepository(Vimeo::class)
            ->findAll();
    }

    protected function getEntity(int $id)
    {
        return $this->getEm()->getRepository(Vimeo::class)
            ->find($id);
    }

    protected function normalizeEntity(Vimeo $entity)
    {
        return [
            'type' => 'vimeo',
            'id'   => $entity->getId(),
            'name' => $entity->getName(),
            'thumbnail'  => $entity->getCoverImage()
        ];
    }
}