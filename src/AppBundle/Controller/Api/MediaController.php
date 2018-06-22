<?php
namespace AppBundle\Controller\Api;

use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Local\Image;
use AppBundle\Entity\Media;
use AppBundle\Form\Type\Distant;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MediaController extends ApiController
{
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

        foreach ($medias as $media) {
            $return[] = $media->getName();
        }

//        echo '<pre>'; var_dump($medias);

        return new Response(json_encode($return), 200, ['Content-Type' => 'application/json']);
    }

}