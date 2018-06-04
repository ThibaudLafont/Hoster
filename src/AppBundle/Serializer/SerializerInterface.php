<?php
namespace AppBundle\Serializer;

interface SerializerInterface
{

    public function serializeAll();
    public function serialize(int $id);

}