<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\ImageUpload;
use AppBundle\Serializer\DailymotionSerializer;
use AppBundle\Serializer\ImageSerializer;
use AppBundle\Serializer\MediaSerializer;
use AppBundle\Serializer\VimeoSerializer;
use AppBundle\Serializer\YoutubeSerializer;
use AppBundle\Service\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{

    /**
     * @Route("/api/medias", name="api_get_all_medias")
     */
    public function getAllMedias()
    {
        $serializer = new MediaSerializer(
            new DailymotionSerializer($this->getDoctrine()->getManager()),
            new YoutubeSerializer($this->getDoctrine()->getManager()),
            new VimeoSerializer($this->getDoctrine()->getManager()),
            new ImageSerializer($this->getDoctrine()->getManager())
        );
        echo '<pre>'; var_dump($serializer->getMediaEntities()); echo '</pre>'; die;
    }

}