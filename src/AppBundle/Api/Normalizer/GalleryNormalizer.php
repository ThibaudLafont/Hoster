<?php
namespace AppBundle\Api\Normalizer;

class GalleryNormalizer
{
    /**
     * @var MediaNormalizer
     */
    private $mediaNormalizer;

    public function __construct(MediaNormalizer $mediaNormalizer)
    {
        $this->setMediaNormalizer($mediaNormalizer);
    }

    public function normalize($gallery)
    {
        // Store Gallery infos
        $return = [
            'id' => $gallery->getId(),
            'title' => $gallery->getTitle(),
            'medias' => []
        ];

        // Loop on every Item inside
        foreach($gallery->getItems() as $item) {
            $return['medias'][] = array_merge( // We merge MediaNormalizer::normalize and position
                    $this->getMediaNormalizer()->normalize($item->getMedia()),
                    ['position' => $item->getPosition()]
                );
        }

        return $return;
    }

    public function normalizeCollection($galleries)
    {
        $return = [];

        foreach ($galleries as $gallery) {
            $return[] = [
                'id' => $gallery->getId(),
                'title' => $gallery->getTitle()
            ];
        }

        return $return;
    }

    /**
     * @return MediaNormalizer
     */
    public function getMediaNormalizer(): MediaNormalizer
    {
        return $this->mediaNormalizer;
    }

    /**
     * @param MediaNormalizer $mediaNormalizer
     */
    public function setMediaNormalizer(MediaNormalizer $mediaNormalizer): void
    {
        $this->mediaNormalizer = $mediaNormalizer;
    }

}