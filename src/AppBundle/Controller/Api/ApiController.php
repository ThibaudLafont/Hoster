<?php
namespace AppBundle\Controller\Api;

use AppBundle\Entity\Distant\Dailymotion;
use AppBundle\Entity\Distant\Vimeo;
use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Local\Image;
use AppBundle\Form\Type\ImageUpload;
use AppBundle\Service\ImageHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{

    protected function buildSuccessContent($entity)
    {
        return json_encode([
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'url' => $entity->getThumbnail()
        ]);
    }

    protected function handleAjaxAdd($form)
    {
        // Check if FILE is defined
        if($form->isSubmitted()) {
            if($form->isValid()) {
                $entity = $form->getData();

                // Persist entity
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                // Created => 201 http status
                $code = 201;
                $content = $this->buildSuccessContent($entity);

            } else {
                // Bad request => 400 http status
                $code = 400;

                // Get & Rewrite errors
                $errors = $form->getErrors(true);
                $errors = str_replace('ERROR', 'Erreur', $errors);

                // Set content
                $content = json_encode($errors);
            }
        } else {
            // Bad request => 400 http status
            $code = 400;
            $content = json_encode('Veuillez poster des données');
        }

        return ['code' => $code, 'content' => $content];
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