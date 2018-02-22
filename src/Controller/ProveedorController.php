<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Proveedor;

use App\Form\ProveedorType;

class ProveedorController extends Controller
{
  /**
   * @Route("/proveedor", name="proveedor")
   */
  public function index()
  {
    $em = $this->getDoctrine()->getRepository(Proveedor::class);
    $proveedores = $em->findAll();

    return $this->render("default/list.proveedor.html.twig",array("proveedores" => $proveedores));
  }
  /**
   * @Route("/proveedor/nuevo", name="proveedorNuevo")
   */
  public function nuevo(Request $request){
    $proveedor = new Proveedor();
    $form = $this->createForm(ProveedorType::class, $proveedor);

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
           'form' => $form->createView(), 
       ));
  }
  /**
   * @Route("/proveedor/edit/{id}", name="proveedorEdit")
   */
  public function edit(Proveedor $proveedor,Request $request){
    $form = $this->createForm(ProveedorType::class, $proveedor);

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
           'form' => $form->createView(),
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
