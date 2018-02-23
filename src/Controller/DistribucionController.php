<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Distribucion;
use App\Form\DistribucionType;

class DistribucionController extends Controller
{
    /**
     * @Route("/distribucion/{tipo}-{number}/edit/{id}", name="distribucionEdit")
     */
    public function edit(Distribucion $distribucion, $tipo,$number,  Request $request)
    {
      $distribucionform = $this->createForm(DistribucionType::class, $distribucion);
      $distribucionform->handleRequest($request);
        if ($distribucionform->isSubmitted() && $distribucionform->isValid()) {
           //$compra = $form->getData();
           // but, the original `$task` variable has also been updated
           //$task = $form->getData();

           $em = $this->getDoctrine()->getManager();
           $em->persist($distribucion);
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
       return $this->render('default/new.html.twig', array("form" => $distribucionform->createView(),)
      );
    }
    /**
     * @Route("/distribucion/{tipo}-{number}/delete/{id}", name="distribucionDelete")
     */
     public function delete(Distribucion $distribucion, $tipo,$number)
     {
       $em = $this->getDoctrine()->getManager();
       $em->remove($distribucion);
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
