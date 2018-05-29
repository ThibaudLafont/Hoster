<?php
namespace AppBundle\Controller;

use AppBundle\Service\ImageHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UploadController extends Controller
{
    /**
     * @var ImageHandler
     */
    private $ih;

    public function __construct(ImageHandler $ih)
    {
        $this->setIh($ih);
    }

    /**
     * @Route("/upload", name="upload")
     */
    public function uploadAction() {
        // Check if FILE is defined
        if(
            isset($_FILES['image']['tmp_name']) &&
            !empty($_FILES['image']['tmp_name'])
        ) {
            // Get ImageManager
            $ih = $this->getIh();
            // Upload
            $img = $ih->upload($_POST['name'], $_POST['alt'], $_FILES['image']);

            // Persist new entity
            $em = $this->getDoctrine()->getManager();
            $em->persist($img);
            $em->flush();
        }

        // Render
        return $this->redirect('/');
    }
    /**
     * @return ImageHandler
     */
    public function getIh(): ImageHandler
    {
        return $this->ih;
    }

    /**
     * @param ImageHandler $ih
     */
    public function setIh(ImageHandler $ih): void
    {
        $this->ih = $ih;
    }

}