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
   * @Route("/detalle/{tipo}-{number}/edit/{id}", name="detalleEdit")
   */
  public function edit(Detalle $detalle, $tipo,$number,  Request $request)
  {
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
         switch ($tipo) {
           case 'Compra':
             return $this->redirectToRoute('compraView',array('id'=>$number));
             break;

           case 'Pago':
             return $this->redirectToRoute('pagoView',array('id'=>$number));
             break;
         }
     }
     return $this->render('default/new.html.twig', array("form" => $detalleform->createView(),)
    );
  }
  /**
   * @Route("/detalle/{tipo}-{number}/delete/{id}", name="detalleDelete")
   */
   public function delete(Detalle $detalle, $tipo,$number)
   {
     $em = $this->getDoctrine()->getManager();
     $em->remove($detalle);
     $em->flush();
     $this->addFlash("Exito",("Detalle eliminado exitosamente"));
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
