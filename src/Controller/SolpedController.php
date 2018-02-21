<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Solped;
use App\Entity\Compra;
use App\Form\SolpedType;
class SolpedController extends Controller
{
  /**
   * @Route("/solped/edit/{tipo}-{number}/{id}", name="solpedEdit")
   */
  public function edit(Solped $solped, $tipo,$number, Request $request)
  {
    $urls = (new MenuController)->list();
    $solpedform = $this->createForm(SolpedType::class, $solped);
    $solpedform->handleRequest($request);
      if ($solpedform->isSubmitted() && $solpedform->isValid()) {
         //$compra = $form->getData();
         // but, the original `$task` variable has also been updated
         //$task = $form->getData();

         $em = $this->getDoctrine()->getManager();
         $em->persist($solped);
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
     return $this->render('default/new.html.twig', array("urls" => $urls , "form" => $solpedform->createView(),)
    );
  }
  /**
   * @Route("/solped/edit/{tipo}-{number}/{id}/{estado}", name="solpedCambioEstado")
   */
   public function cambioEstado(Solped $solped, $tipo,$number,$estado){
     $solped->setEstado($estado);
     $em = $this->getDoctrine()->getManager();
     $em->persist($solped);
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
