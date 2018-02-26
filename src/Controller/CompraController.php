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
use App\Entity\Attachment;
use App\Entity\Distribucion;
use App\Form\CompraType;
use App\Form\SolpedType;
use App\Form\OcType;
use App\Form\DetalleType;
use App\Form\DistribucionType;
use App\Form\AttachmentType;
use App\Service\FileUploader;
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
     * @Route("/compra/{page}", name="compra",requirements={"page"="\d+"})
     */
    public function index($page = 1)
    {
      $em = $this->getDoctrine()->getRepository(Compra::class);
      $compras = $em->getAllCompras($page);
      $limit = 10;
      $maxPages = ceil($compras->count() / $limit);
      $thisPage = $page;
      return $this->render("default/list.compra.html.twig",compact('maxPages', 'thisPage','compras'));
    }

    /**
    * @Route("/compra/nuevo", name="compraNuevo")
    */
    public function nuevo(Request $request)
    {
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
             'form' => $form->createView(),
         ));
    }
    /**
    * @Route("/compra/view/{id}", name="compraView")
    */
    public function view(Compra $compra, Request $request , FileUploader $fileUploader){
      $solped = new Solped;
      $oc = new OC;
      $distribucion = new Distribucion;
      $attachment = new Attachment;
      $detalle = new Detalle;
      $detalle->setTipo($compra->getTipo());
      $detalle->setMedida("UND");
      $detalle->setTiempo("D");
      $detalle->setCantidad(1);
      $attachmentform = $this->createForm(AttachmentType::class,$attachment);
      $detalleform = $this->createForm(DetalleType::class, $detalle);
      $distribucionform = $this->createForm(DistribucionType::class, $distribucion);
      $solpedform = $this->createForm(SolpedType::class, $solped);
      $ocform = $this->createForm(OcType::class, $oc);
      $detalleform->handleRequest($request);
      $solpedform->handleRequest($request);
      $ocform->handleRequest($request);
      $attachmentform->handleRequest($request);
      $distribucionform->handleRequest($request);
      $id = $compra->getId();

      if ($attachmentform->isSubmitted() && $attachmentform->isValid()) {
        $file = $attachment->getBrochure();
        $fileName = $fileUploader->upload($file);
        $attachment->setBrochure($fileName);
        $compra->addAttachment($attachment);
        $em = $this->getDoctrine()->getManager();
        $em->persist($attachment);
        $em->flush();
        $this->addFlash("Exito",("Archivo agregado exitosamente"));
        return $this->redirectToRoute('compraView',array('id'=>$compra->getId()));
     }
      if ($distribucionform->isSubmitted() && $distribucionform->isValid()) {
        $compra->addDistribucion($distribucion);
        $em = $this->getDoctrine()->getManager();
        $em->persist($distribucion);
        $em->flush();
        $this->addFlash("Exito",("Distribución agregada exitosamente"));
        return $this->redirectToRoute('compraView',array('id'=>$compra->getId()));
     }
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
        $compra->addDetalle($detalle);
        $em = $this->getDoctrine()->getManager();
        $em->persist($detalle);
        $em->flush();
        $this->addFlash("Exito",("Detalle agregado exitosamente"));
        return $this->redirectToRoute('compraView',array('id'=>$compra->getId()));
    }

      return $this->render('default/view.compra.html.twig', array(
         'compra' => $compra, "forms" => array ("solped" => $solpedform->createView(),"oc" => $ocform->createView(),"detalle" => $detalleform->createView(), "distribucion" => $distribucionform->createView(), "attachment" => $attachmentform->createView(),)
     ));
    }
    /**
    * @Route("/compra/edit/{id}", name="compraEdit")
    */
    public function edit(Compra $compra,Request $request)
    {
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
             'form' => $form->createView(),
         ));
    }
}
