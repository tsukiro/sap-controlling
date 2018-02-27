<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use App\Entity\Attachment;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class AttachmentController extends Controller
{
    /**
     * @Route("/attachment/remove/{tipo}-{n}/{id}", name="attachmentRemove")
     */
    public function index(Attachment $attachment,$tipo,$n, Request $request)
    {
        $fs = new Filesystem();
        $fs->remove("files/".$attachment->getBrochure());
        $em = $this->getDoctrine()->getManager();
        $em->remove($attachment);
        $em->flush();
        $this->addFlash("Exito",("ARchivo eliminado exitosamente"));
        switch ($tipo) {
          case 'Compra':
            return $this->redirectToRoute('compraView',array('id'=>$n));
            break;

          case 'Pago':
            return $this->redirectToRoute('pagoView',array('id'=>$n));
            break;
        }
    }
}
