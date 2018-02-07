<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Proveedor;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProveedorController extends Controller
{
  /**
   * @Route("/proveedor", name="proveedor")
   */
  public function index()
  {

    $urls = MenuController::list();
    $em = $this->getDoctrine()->getRepository(Proveedor::class);
    $proveedores = $em->findAll();

    return $this->render("default/list.proveedor.html.twig",array("urls" => $urls,"proveedores" => $proveedores));
  }
  /**
   * @Route("/proveedor/nuevo", name="proveedorNuevo")
   */
  public function nuevo(Request $request){
    $urls = MenuController::list();
    $proveedor = new Proveedor();
    $form = $this->createFormBuilder($proveedor)
        ->add('rut', TextType::class)
        ->add('nombre', TextType::class)
        ->add('save', SubmitType::class, array('label' => 'Agregar Proveedor'))
        ->getForm();

     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        //$task = $form->getData();


         $em = $this->getDoctrine()->getManager();
         $em->persist($proveedor);
         $em->flush();
        $this->addFlash("Exito","Se ha creado el proveedor exitosamente.");
        return $this->redirectToRoute('proveedor');
    }
        return $this->render('default/new.html.twig', array(
           'form' => $form->createView(), "urls" => $urls ,
       ));
  }
  /**
   * @Route("/proveedor/edit/{id}", name="proveedorEdit")
   */
  public function edit(Proveedor $proveedor,Request $request){
    $urls = MenuController::list();
    $form = $this->createFormBuilder($proveedor)
    ->add('rut', TextType::class)
    ->add('nombre', TextType::class)
    ->add('save', SubmitType::class, array('label' => 'Editar Proveedor'))
    ->getForm();

     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $task = $form->getData();


         $em = $this->getDoctrine()->getManager();
         $em->persist($proveedor);
         $em->flush();
        $this->addFlash("Exito","Se ha modificado el proveedor exitosamente.");
        return $this->redirectToRoute('proveedor');
    }
        return $this->render('default/new.html.twig', array(
           'form' => $form->createView(), 'urls' => $urls,
       ));
  }
  /**
   * @Route("/proveedor/delete/{id}", name="proveedorDelete")
   */
  public function eliminar($id){
      $em = $this->getDoctrine()->getManager();
      $proveedor = $em->getRepository(Proveedor::class)->find($id);
      if (!$proveedor) {
          throw $this->createNotFoundException(
              'No se ha encontrado el usuario  '.$id
          );
      }
      $em->remove($proveedor);
      $em->flush();
      $this->addFlash("Exito","Proveedor eliminado correctamente.");
      return $this->redirectToRoute('proveedor');
  }
}
