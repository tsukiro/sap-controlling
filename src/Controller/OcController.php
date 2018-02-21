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
   * @Route("/oc/edit/{id}/{compra}", name="ocEditCompra")
   */
  public function edit(OC $oc, $compra, Request $request)
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
         return $this->redirectToRoute('compraView',array('id'=>$compra));
     }
     return $this->render('default/new.html.twig', array("urls" => $urls , "form" => $ocform->createView(),)
    );
  }
  /**
   * @Route("/oc/edit/{id}/{compra}/{estado}", name="ocCambioEstadoCompra")
   */
   public function cambioEstado(OC $oc,$compra,$estado){
     $oc->setEstado($estado);
     $em = $this->getDoctrine()->getManager();
     $em->persist($oc);
     $em->flush();
     $this->addFlash("Exito",("Se ha cambiado el estado exitosamente."));
     return $this->redirectToRoute('compraView',array('id'=>$compra));
   }
  /**
   * @Route("/oc/edit/{id}/{pago}", name="ocEditPago")
   */
  public function edit2(OC $oc, $pago, Request $request)
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
         return $this->redirectToRoute('pagoView',array('id'=>$pago));
     }
     return $this->render('default/new.html.twig', array("urls" => $urls , "form" => $ocform->createView(),)
    );
  }
  /**
   * @Route("/oc/edit/{id}/{pago}/{estado}", name="ocCambioEstadoPago")
   */
   public function cambioEstado2(OC $oc,$pago,$estado){
     $oc->setEstado($estado);
     $em = $this->getDoctrine()->getManager();
     $em->persist($oc);
     $em->flush();
     $this->addFlash("Exito",("Se ha cambiado el estado exitosamente."));
     return $this->redirectToRoute('pagoView',array('id'=>$pago));
   }
}
