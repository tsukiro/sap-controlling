<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Compra;
use App\Entity\Usuario;
use App\Entity\Proveedor;
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
    public function nuevo(Request $request){
      $urls = MenuController::list();
      $compra = new Compra();
      $compra->setFecha(new \DateTime('today'));
      $form = $this->createFormBuilder($compra)
          //->add('nombre', TextType::class)
          ->add('descripcion', TextType::class)
          ->add('solicitante', TextType::class)
          ->add('usuario', EntityType::class,array(
              'class' => Usuario::class,
              'choice_label' => 'nombre',
          ))
          ->add('proveedor', EntityType::class,array(
              'class' => Proveedor::class,
              'choice_label' => 'nombre',
          ))
          ->add('fecha', DateType::class,array( 'format' => 'ddMMyyyy',))
          ->add('tipo', ChoiceType::class,array(
              'choices'  => array(
                  'Material' => 0,
                  'Servicio' => 1,
              )))
          ->add('save', SubmitType::class, array('label' => 'Agregar Usuario'))
          ->getForm();

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
          // $form->getData() holds the submitted values
          // but, the original `$task` variable has also been updated
          //$task = $form->getData();


           $em = $this->getDoctrine()->getManager();
           $em->persist($usuario);
           $em->flush();
          $this->addFlash("Exito","Se ha creado el usuario exitosamente.");
          return $this->redirectToRoute('usuario');
      }
          return $this->render('default/new.html.twig', array(
             'form' => $form->createView(), "urls" => $urls ,
         ));
    }
}
