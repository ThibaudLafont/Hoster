<?php
namespace AppBundle\Controller\Api;

use AppBundle\Entity\Distant\Dailymotion;
use AppBundle\Form\Type\Distant;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DailymotionController extends ApiController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/add/dailymotion/ajax", name="dailymotion_ajax_upload")
     */
    public function ajaxAddAction(Request $request)
    {
        // Form
        $form = $this->createForm(Distant::class, new Dailymotion());
        $form->handleRequest($request);

        $response = $this->handleAjaxAdd($form);

        return $this->renderAjax($response['code'], $response['content']);
    }
}