<?php
namespace AppBundle\Controller\Api;

use AppBundle\Entity\Distant\Youtube;
use AppBundle\Form\Type\Distant;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class YoutubeController extends ApiController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/add/youtube/ajax", name="youtube_ajax_upload")
     */
    public function ajaxAddAction(Request $request)
    {
        // Form
        $form = $this->createForm(Distant::class, new Youtube());
        $form->handleRequest($request);

        $response = $this->handleAjaxAdd($form);

        return $this->renderAjax($response['code'], $response['content']);
    }

}