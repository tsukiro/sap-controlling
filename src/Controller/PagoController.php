<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Pago;
use App\Entity\Usuario;
use App\Entity\Solped;
use App\Entity\OC;
use App\Entity\Detalle;
use App\Entity\Proveedor;
use App\Form\PagoType;
use App\Form\SolpedType;
use App\Form\OcType;
use App\Form\DetalleType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PagoController extends Controller
{
  /**
   * @Route("/pago", name="pago")
   */
  public function index()
  {
    $urls = MenuController::list();
    $em = $this->getDoctrine()->getRepository(Pago::class);
    $pagos = $em->findAll();

    return $this->render("default/list.pago.html.twig",array("urls" => $urls,"pagos" => $pagos));
  }

  /**
  * @Route("/pago/nuevo", name="pagoNuevo")
  */
  public function nuevo(Request $request)
  {
    $urls = MenuController::list();
    $pago = new Pago();
    $pago->setEstado(0);
    $form = $this->createForm(PagoType::class, $pago);

     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid()) {
        //$compra = $form->getData();
        // but, the original `$task` variable has also been updated
        //$task = $form->getData();


         $em = $this->getDoctrine()->getManager();

         $em->persist($pago);
         $em->flush();
        $this->addFlash("Exito",("Creado exitosamente"));
        return $this->redirectToRoute('pago');
    }
        return $this->render('default/new.html.twig', array(
           'form' => $form->createView(), "urls" => $urls ,
       ));
  }
  /**
  * @Route("/pago/view/{id}", name="pagoView")
  */
  public function view(Pago $pago, Request $request){
    $urls = (new MenuController)->list();
    $solped = new Solped;
    $oc = new OC;
    $detalle = new Detalle;
    $detalle->setTipo($pago->getTipo());
    $detalle->setMedida("UND");
    $detalle->setTiempo("D");
    $detalle->setCantidad(1);
    $detalleform = $this->createForm(DetalleType::class, $detalle);
    $solpedform = $this->createForm(SolpedType::class, $solped);
    $ocform = $this->createForm(OcType::class, $oc);
    $detalleform->handleRequest($request);
    $solpedform->handleRequest($request);
    $ocform->handleRequest($request);
    $id = $pago->getId();

    if ($solpedform->isSubmitted() && $solpedform->isValid()) {
       //$compra = $form->getData();
       // but, the original `$task` variable has also been updated
       //$task = $form->getData();
       $pago->addSolped($solped);
       $em = $this->getDoctrine()->getManager();
       $em->persist($solped);
       $em->flush();
       $this->addFlash("Exito",("Solped creada exitosamente"));
       return $this->redirectToRoute('pagoView',array('id'=>$pago->getId()));
   }
   if ($ocform->isSubmitted() && $ocform->isValid()) {
      //$compra = $form->getData();
      // but, the original `$task` variable has also been updated
      //$task = $form->getData();
      $pago->addOc($oc);
      $em = $this->getDoctrine()->getManager();
      $em->persist($oc);
      $em->flush();
      $this->addFlash("Exito",("OC creada exitosamente"));
      return $this->redirectToRoute('pagoView',array('id'=>$pago->getId()));
  }
   if ($detalleform->isSubmitted() && $detalleform->isValid()) {
      //$compra = $form->getData();
      // but, the original `$task` variable has also been updated
      //$task = $form->getData();
      $detalle->setPago($pago);
      $em = $this->getDoctrine()->getManager();
      $em->persist($detalle);
      $em->flush();
      $this->addFlash("Exito",("OC creada exitosamente"));
      return $this->redirectToRoute('pagoView',array('id'=>$pago->getId()));
  }

    return $this->render('default/view.pago.html.twig', array(
       'pago' => $pago, "urls" => $urls , "forms" => array ("solped" => $solpedform->createView(),"oc" => $ocform->createView(),"detalle" => $detalleform->createView(),)
   ));
  }
  /**
  * @Route("/pago/edit/{id}", name="pagoEdit")
  */
  public function edit(Pago $pago,Request $request)
  {
    $urls = MenuController::list();
    $pago->setEstado(0);
    $form = $this->createForm(PagoType::class, $pago);


     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid()) {
        //$compra = $form->getData();
        // but, the original `$task` variable has also been updated
        //$task = $form->getData();


         $em = $this->getDoctrine()->getManager();

         $em->persist($pago);
         $em->flush();
        $this->addFlash("Exito",("Editado exitosamente"));
        return $this->redirectToRoute('pagoView',array("id"=>$pago->getId()));
    }
        return $this->render('default/new.html.twig', array(
           'form' => $form->createView(), "urls" => $urls ,
       ));
  }
}
