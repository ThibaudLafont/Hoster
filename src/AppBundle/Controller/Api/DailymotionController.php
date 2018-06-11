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

        // Check if FILE is defined
        if($form->isSubmitted()) {
            if($form->isValid()) {
                $dm = $form->getData();

                // Persist entity
                $em = $this->getDoctrine()->getManager();
                $em->persist($dm);
                $em->flush();

                $code = 201;
                $content = json_encode([
                    'id' => $dm->getId(),
                    'name' => $dm->getName(),
                    'type' => 'dailymotion',
                    'url' => $dm->getCoverImage()
                ]);

            } else {
                $code = 400;
                $content = json_encode((string) $form->getErrors(true, false));
            }
        } else {
            $code = 400;
            $content = json_encode('Veuillez poster des données');
        }

        return $this->renderAjax($code, $content);
    }

}