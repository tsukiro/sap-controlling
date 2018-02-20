<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Detalle;
use App\Form\DetalleType;
class DetalleController extends Controller
{
  /**
   * @Route("/detalle/edit/{id}/{compra}", name="detalleEditCompra")
   */
  public function edit(Detalle $detalle, $compra, Request $request)
  {
    $urls = (new MenuController)->list();
    $detalleform = $this->createForm(DetalleType::class, $detalle);
    $detalleform->handleRequest($request);
      if ($detalleform->isSubmitted() && $detalleform->isValid()) {
         //$compra = $form->getData();
         // but, the original `$task` variable has also been updated
         //$task = $form->getData();

         $em = $this->getDoctrine()->getManager();
         $em->persist($detalle);
         $em->flush();
         $this->addFlash("Exito",("Detalle modificado exitosamente"));
         return $this->redirectToRoute('compraView',array('id'=>$compra));
     }
     return $this->render('default/new.html.twig', array("urls" => $urls , "form" => $detalleform->createView(),)
    );
  }
  /**
   * @Route("/detalle/delete/{id}/{compra}", name="detalleDeleteCompra")
   */
   public function delete(Detalle $detalle, $compra)
   {
     $urls = (new MenuController)->list();
     $em = $this->getDoctrine()->getManager();
     $em->remove($detalle);
     $em->flush();
     $this->addFlash("Exito",("Detalle eliminado exitosamente"));
      return $this->redirectToRoute('compraView',array('id'=>$compra));

   }
}
