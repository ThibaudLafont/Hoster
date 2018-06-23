<?php
namespace AppBundle\Controller\Api;

use AppBundle\Api\Normalizer\GalleryNormalizer;
use AppBundle\Entity\Gallery\Gallery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends ApiController
{
    /**
     * @var GalleryNormalizer
     */
    private $normalizer;

    public function __construct(GalleryNormalizer $normalizer)
    {
        $this->setNormalizer($normalizer);
    }

    /**
     * @param Request $request
     *
     * @Route("/api/galleries", name="api_get_all_galleries")
     * @return Response
     */
    public function getAllGalleriesAction(Request $request)
    {
        $medias = $this->getDoctrine()->getManager()
            ->getRepository(Gallery::class)
            ->findAll();

        $normalized = $this->getNormalizer()->normalizeCollection($medias);

        return new Response(json_encode($normalized), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/api/gallery/{id}", name="api_get_gallery")
     * @param $id
     * @return Response
     */
    public function getGalleryAction($id)
    {
        $media = $this->getDoctrine()->getManager()
            ->getRepository(Gallery::class)
            ->find($id);

        $normalized = $this->getNormalizer()->normalize($media);

        return new Response(json_encode($normalized), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @return GalleryNormalizer
     */
    public function getNormalizer(): GalleryNormalizer
    {
        return $this->normalizer;
    }

    /**
     * @param GalleryNormalizer $normalizer
     */
    public function setNormalizer(GalleryNormalizer $normalizer): void
    {
        $this->normalizer = $normalizer;
    }
}