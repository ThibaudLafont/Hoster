<?php
namespace AppBundle\Api\Normalizer;

class MediaNormalizer
{

    public function normalize($media)
    {
        if($media->getType() === 'image') {
            return $this->normalizeImage($media);
        } else {
            return $this->normalizeDistant($media);
        }
    }

    public function normalizeCollection($medias)
    {
        $return = [];

        foreach ($medias as $media) {
            $return[] = $this->normalize($media);
        }

        return $return;
    }

    private function normalizeDistant($media)
    {
        return [
            'id' => $media->getId(),
            'type' => $media->getType(),
            'name' => $media->getName(),
            'src' => $media->getSrc(),
            'thumbnail' => $media->getThumbnail()
        ];
    }

    private function normalizeImage($media)
    {
        $return = $this->normalizeDistant($media);
        // Merge description for images and return
        return array_merge($return, ['alt' => $media->getAlt()]);
    }


}