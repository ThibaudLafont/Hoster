<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Distant\Vimeo;
use AppBundle\Form\Type\Distant;
use AppBundle\Form\Type\ImageUpload;
use AppBundle\Service\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class VimeoController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/add/vimeo", name="vimeo_add")
     */
    public function addAction(Request $request)
    {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $vids = $em->getRepository(Vimeo::class)->findAll();

        // Form
        $form = $this->createForm(Distant::class, new Vimeo());
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Persist entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            // Return to image_upload
            return $this->redirectToRoute('vimeo_add');
        }

        return $this->render(
            'distant/add.html.twig',
            [
                'type' => 'Vimeo',
                'vids' => $vids,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route("/edit/vimeo/{id}", name="vimeo_edit")
     */
    public function editAction(Request $request, int $id)
    {
        // Get images
        $em = $this->getDoctrine()->getManager();
        $vid = $em->getRepository(Vimeo::class)->find($id);

        // Form
        $form = $this->createForm(Distant::class, $vid);
        $form->handleRequest($request);

        // Check if form was submitted
        if($form->isSubmitted() && $form->isValid()) {
            // Flush update
            $em->flush();

            // Return to image_upload
            return $this->redirectToRoute('vimeo_add');
        }

        return $this->render(
            'default/edit.html.twig',
            [
                'type' => 'Vimeo',
                'media' => $vid,
                'form' => $form->createView()
            ]
        );

    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/delete/vimeo/{id}", name="vimeo_delete")
     */
    public function deleteAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $vid = $em->getRepository(Vimeo::class)->find($id);

        $em->remove($vid);
        $em->flush();

        return $this->redirectToRoute('vimeo_add');
    }

}