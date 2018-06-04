<?php
namespace AppBundle\Serializer;

use AppBundle\Entity\Distant\Dailymotion;

class DailymotionSerializer extends Serializer
{
    protected function getEntities()
    {
        return $this->getEm()->getRepository(Dailymotion::class)
            ->findAll();
    }

    protected function getEntity(int $id)
    {
        return $this->getEm()->getRepository(Dailymotion::class)
            ->find($id);
    }

    protected function normalizeEntity(Dailymotion $entity)
    {
        return [
            'type' => 'dailymotion',
            'id'   => $entity->getId(),
            'name' => $entity->getName(),
            'thumbnail'  => $entity->getCoverImage()
        ];
    }
}