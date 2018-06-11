<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Distant\Youtube;
use AppBundle\Form\Type\Distant;
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
        // Get images
        $em = $this->getDoctrine()->getManager();
        $vids = $em->getRepository(Youtube::class)->findAll();

        // Form
        $form = $this->createForm(Distant::class, new Youtube());
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Persist entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            // Return to image_upload
            return $this->redirectToRoute('youtube_add');
        }

        return $this->render(
            'distant/youtube/add.html.twig',
            ['vids' => $vids, 'form' => $form->createView()]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/add/youtube/ajax", name="youtube_ajax_upload")
     */
    public function ajaxAddAction(Request $request)
    {
        // Form
        $form = $this->createForm(Distant::class, new Youtube());
        $form->handleRequest($request);

        // Check if FILE is defined
        if($form->isSubmitted()) {
            if($form->isValid()) {
                $yt = $form->getData();

                // Persist entity
                $em = $this->getDoctrine()->getManager();
                $em->persist($yt);
                $em->flush();

                $content = json_encode([
                    'id' => $yt->getId(),
                    'name' => $yt->getName(),
                    'type' => 'youtube',
                    'url' => $yt->getCoverImage()
                ]);

            } else {
                $content = json_encode((string) $form->getErrors(true, false));
            }
        } else {
            $content = json_encode('Veuillez poster des données');
        }

        // Build Response
        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route("/edit/youtube/{id}", name="youtube_edit")
     */
    public function editAction(Request $request, int $id)
    {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $vid = $em->getRepository(Youtube::class)->find($id);

        // Form
        $form = $this->createForm(Distant::class, $vid);
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Flush update
            $em->flush();

            // Return to image_upload
            return $this->redirectToRoute('youtube_add');
        }

        return $this->render(
            'distant/youtube/edit.html.twig',
            ['vid' => $vid, 'form' => $form->createView()]
        );

    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/delete/youtube/{id}", name="youtube_delete")
     */
    public function deleteAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $vid = $em->getRepository(Youtube::class)->find($id);

        $em->remove($vid);
        $em->flush();

        return $this->redirectToRoute('youtube_add');
    }

}