<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\OC;
use App\Entity\Compra;
use App\Form\OcType;
class OcController extends Controller
{
  /**
   * @Route("/oc/edit/{tipo}-{number}/{id}", name="ocEdit")
   */
  public function edit(OC $oc,$tipo,$number, Request $request)
  {
    $urls = (new MenuController)->list();
    $ocform = $this->createForm(OcType::class, $oc);
    $ocform->handleRequest($request);
      if ($ocform->isSubmitted() && $ocform->isValid()) {
         //$compra = $form->getData();
         // but, the original `$task` variable has also been updated
         //$task = $form->getData();

         $em = $this->getDoctrine()->getManager();
         $em->persist($oc);
         $em->flush();
         $this->addFlash("Exito",("Solped editada exitosamente"));
         switch ($tipo) {
           case 'Compra':
             return $this->redirectToRoute('compraView',array('id'=>$number));
             break;

           case 'Pago':
             return $this->redirectToRoute('pagoView',array('id'=>$number));
             break;
         }
     }
     return $this->render('default/new.html.twig', array("urls" => $urls , "form" => $ocform->createView(),)
    );
  }
  /**
   * @Route("/oc/edit/{tipo}-{number}/{id}/{estado}", name="ocCambioEstado")
   */
   public function cambioEstado(OC $oc,$tipo,$number,$estado){
     $oc->setEstado($estado);
     $em = $this->getDoctrine()->getManager();
     $em->persist($oc);
     $em->flush();
     $this->addFlash("Exito",("Se ha cambiado el estado exitosamente."));
     switch ($tipo) {
       case 'Compra':
         return $this->redirectToRoute('compraView',array('id'=>$number));
         break;

       case 'Pago':
         return $this->redirectToRoute('pagoView',array('id'=>$number));
         break;
     }
   }
}
