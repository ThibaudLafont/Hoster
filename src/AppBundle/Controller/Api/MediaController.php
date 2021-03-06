<?php
namespace AppBundle\Controller\Api;

use AppBundle\Api\Normalizer\MediaNormalizer;
use AppBundle\Entity\Media;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MediaController extends ApiController
{
    /**
     * @var MediaNormalizer
     */
    private $normalizer;

    public function __construct(MediaNormalizer $normalizer)
    {
        $this->setNormalizer($normalizer);
    }

    /**
     * @param Request $request
     *
     * @Route("/api/medias", name="api_get_all_medias")
     * @return Response
     */
    public function getAllMediasAction(Request $request)
    {
        $medias = $this->getDoctrine()->getManager()
            ->getRepository(Media::class)
            ->findAll();

        $normalized = $this->getNormalizer()->normalizeCollection($medias);

        return new Response(json_encode($normalized), 200, ['Content-Type' => 'application/json']);
    }

    /**     *
     * @Route("/api/media/{id}", name="api_get_media")
     * @param $id
     * @return Response
     */
    public function getMediaAction($id)
    {
        $media = $this->getDoctrine()->getManager()
            ->getRepository(Media::class)
            ->find($id);

        $normalized = $this->getNormalizer()->normalize($media);

        return new Response(json_encode($normalized), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @return MediaNormalizer
     */
    public function getNormalizer(): MediaNormalizer
    {
        return $this->normalizer;
    }

    /**
     * @param MediaNormalizer $normalizer
     */
    public function setNormalizer(MediaNormalizer $normalizer): void
    {
        $this->normalizer = $normalizer;
    }
}