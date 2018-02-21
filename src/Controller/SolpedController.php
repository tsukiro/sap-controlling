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
   * @Route("/solped/edit/{tipo}/{id}", name="solpedEdit")
   */
  public function edit(Solped $solped, $tipo, Request $request)
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
         
         return $this->redirectToRoute('compraView',array('id'=>$compra));
     }
     return $this->render('default/new.html.twig', array("urls" => $urls , "form" => $solpedform->createView(),)
    );
  }
  /**
   * @Route("/solped/edit/{id}/{compra}/{estado}", name="solpedCambioEstadoCompra")
   */
   public function cambioEstado(Solped $solped,$compra,$estado){
     $solped->setEstado($estado);
     $em = $this->getDoctrine()->getManager();
     $em->persist($solped);
     $em->flush();
     $this->addFlash("Exito",("Se ha cambiado el estado exitosamente."));
     return $this->redirectToRoute('compraView',array('id'=>$compra));
   }

}
