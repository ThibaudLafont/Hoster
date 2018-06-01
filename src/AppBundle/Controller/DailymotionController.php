<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Distant\Dailymotion;
use AppBundle\Entity\Distant\Youtube;
use AppBundle\Entity\Local\Image;
use AppBundle\Form\Type\Distant;
use AppBundle\Form\Type\ImageUpload;
use AppBundle\Service\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DailymotionController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/add/dailymotion", name="dailymotion_add")
     */
    public function addAction(Request $request)
    {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $vids = $em->getRepository(Dailymotion::class)->findAll();

        // Form
        $form = $this->createForm(Distant::class, new Dailymotion());
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Persist entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            // Return to image_upload
            return $this->redirectToRoute('dailymotion_add');
        }

        return $this->render(
            'distant/dailymotion/add.html.twig',
            ['vids' => $vids, 'form' => $form->createView()]
        );
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route("/edit/dailymotion/{id}", name="dailymotion_edit")
     */
    public function editAction(Request $request, int $id)
    {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $vid = $em->getRepository(Dailymotion::class)->find($id);

        // Form
        $form = $this->createForm(Distant::class, $vid);
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Flush update
            $em->flush();

            // Return to image_upload
            return $this->redirectToRoute('dailymotion_add');
        }

        return $this->render(
            'distant/dailymotion/edit.html.twig',
            ['vid' => $vid, 'form' => $form->createView()]
        );

    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/delete/dailymotion/{id}", name="dailymotion_delete")
     */
    public function deleteAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $vid = $em->getRepository(Dailymotion::class)->find($id);

        $em->remove($vid);
        $em->flush();

        return $this->redirectToRoute('dailymotion_add');
    }

}