<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\ImageUpload;
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
        $serializer = new YoutubeSerializer($this->getDoctrine()->getManager());
        echo '<pre>'; var_dump($serializer->serializeAll()); echo '</pre>'; die;
    }

}