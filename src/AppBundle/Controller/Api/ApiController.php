<?php
namespace AppBundle\Controller\Api;

use AppBundle\Entity\Distant\Dailymotion;
use AppBundle\Form\Type\ImageUpload;
use AppBundle\Serializer\DailymotionSerializer;
use AppBundle\Serializer\ImageSerializer;
use AppBundle\Serializer\MediaSerializer;
use AppBundle\Serializer\VimeoSerializer;
use AppBundle\Serializer\YoutubeSerializer;
use AppBundle\Service\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{

    protected function buildSuccessContent($entity)
    {
        switch(get_class($entity)){
            case Dailymotion::class:
                $type = 'dailymotion';
                break;
        }
        return ['sucess', json_encode([
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'type' => $type,
            'url' => $entity->getCoverImage()
        ])];
    }

    protected function renderAjax($code, $content)
    {
        // Build Response
        $response = new Response($content, $code);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}