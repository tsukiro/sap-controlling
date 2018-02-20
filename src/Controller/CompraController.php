<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Compra;
use App\Entity\Usuario;
use App\Entity\Solped;
use App\Entity\OC;
use App\Entity\Detalle;
use App\Entity\Proveedor;
use App\Form\CompraType;
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


class CompraController extends Controller
{
    /**
     * @Route("/compra", name="compra")
     */
    public function index()
    {
      $urls = MenuController::list();
      $em = $this->getDoctrine()->getRepository(Compra::class);
      $compras = $em->findAll();

      return $this->render("default/list.compra.html.twig",array("urls" => $urls,"compras" => $compras));
    }

    /**
    * @Route("/compra/nuevo", name="compraNuevo")
    */
    public function nuevo(Request $request)
    {
      $urls = MenuController::list();
      $compra = new Compra();
      $compra->setEstado(0);
      $form = $this->createForm(CompraType::class, $compra);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
          //$compra = $form->getData();
          // but, the original `$task` variable has also been updated
          //$task = $form->getData();


           $em = $this->getDoctrine()->getManager();

           $em->persist($compra);
           $em->flush();
          $this->addFlash("Exito",("Creado exitosamente"));
          return $this->redirectToRoute('compra');
      }
          return $this->render('default/new.html.twig', array(
             'form' => $form->createView(), "urls" => $urls ,
         ));
    }
    /**
    * @Route("/compra/view/{id}", name="compraView")
    */
    public function view(Compra $compra, Request $request){
      $urls = (new MenuController)->list();
      $solped = new Solped;
      $oc = new OC;
      $detalle = new Detalle;
      $detalle->setTipo($compra->getTipo());
      $detalle->setMedida("UND");
      $detalle->setTiempo("D");
      $detalle->setCantidad(1);
      $detalleform = $this->createForm(DetalleType::class, $detalle);
      $solpedform = $this->createForm(SolpedType::class, $solped);
      $ocform = $this->createForm(OcType::class, $oc);
      $detalleform->handleRequest($request);
      $solpedform->handleRequest($request);
      $ocform->handleRequest($request);
      $id = $compra->getId();

      if ($solpedform->isSubmitted() && $solpedform->isValid()) {
         //$compra = $form->getData();
         // but, the original `$task` variable has also been updated
         //$task = $form->getData();
         $compra->addSolped($solped);
         $em = $this->getDoctrine()->getManager();
         $em->persist($solped);
         $em->flush();
         $this->addFlash("Exito",("Solped creada exitosamente"));
         return $this->redirectToRoute('compraView',array('id'=>$compra->getId()));
     }
     if ($ocform->isSubmitted() && $ocform->isValid()) {
        //$compra = $form->getData();
        // but, the original `$task` variable has also been updated
        //$task = $form->getData();
        $compra->addOc($oc);
        $em = $this->getDoctrine()->getManager();
        $em->persist($oc);
        $em->flush();
        $this->addFlash("Exito",("OC creada exitosamente"));
        return $this->redirectToRoute('compraView',array('id'=>$compra->getId()));
    }
     if ($detalleform->isSubmitted() && $detalleform->isValid()) {
        //$compra = $form->getData();
        // but, the original `$task` variable has also been updated
        //$task = $form->getData();
        $detalle->setCompra($compra);
        $em = $this->getDoctrine()->getManager();
        $em->persist($detalle);
        $em->flush();
        $this->addFlash("Exito",("OC creada exitosamente"));
        return $this->redirectToRoute('compraView',array('id'=>$compra->getId()));
    }

      return $this->render('default/view.compra.html.twig', array(
         'compra' => $compra, "urls" => $urls , "forms" => array ("solped" => $solpedform->createView(),"oc" => $ocform->createView(),"detalle" => $detalleform->createView(),)
     ));
    }
    /**
    * @Route("/compra/edit/{id}", name="compraEdit")
    */
    public function edit(Compra $compra,Request $request)
    {
      $urls = MenuController::list();
      $compra->setEstado(0);
      $form = $this->createForm(CompraType::class, $compra);


       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
          //$compra = $form->getData();
          // but, the original `$task` variable has also been updated
          //$task = $form->getData();


           $em = $this->getDoctrine()->getManager();

           $em->persist($compra);
           $em->flush();
          $this->addFlash("Exito",("Editado exitosamente"));
          return $this->redirectToRoute('compraView',array("id"=>$compra->getId()));
      }
          return $this->render('default/new.html.twig', array(
             'form' => $form->createView(), "urls" => $urls ,
         ));
    }
}
