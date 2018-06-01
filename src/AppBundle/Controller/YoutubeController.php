<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Local\Image;
use AppBundle\Form\Type\ImageUpload;
use AppBundle\Service\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class YoutubeController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/add/youtube", name="youtube_add")
     */
    public function addAction(Request $request)
    {
        return $this->render('distant/youtube/add.html.twig');
    }

}