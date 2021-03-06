<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


use App\Entity\Usuario;
use App\Form\UsuarioType;

class UsuarioController extends Controller
{

    /**
     * @Route("/usuario", name="usuario")
     */
    public function index()
    {
      $em = $this->getDoctrine()->getRepository(Usuario::class);
      $usuarios = $em->findAll();

      return $this->render("default/list.usuario.html.twig",array("usuarios" => $usuarios));
    }
    /**
     * @Route("/usuario/nuevo", name="usuarioNuevo")
     */
    public function nuevo(Request $request,UserPasswordEncoderInterface $passwordEncoder){
      $usuario = new Usuario();
      $form = $this->createForm(UsuarioType::class,$usuario);


       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
          // $form->getData() holds the submitted values
          // but, the original `$task` variable has also been updated
          //$task = $form->getData();

            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
           $usuario->setPassword($password);
           $em = $this->getDoctrine()->getManager();
           $em->persist($usuario);
           $em->flush();
          $this->addFlash("Exito","Se ha creado el usuario exitosamente.");
          return $this->redirectToRoute('usuario');
      }
          return $this->render('default/new.html.twig', array(
             'form' => $form->createView(),
         ));
    }
    /**
     * @Route("/usuario/edit/{id}", name="usuarioEdit")
     */
    public function edit(Usuario $usuario,Request $request,UserPasswordEncoderInterface $passwordEncoder){
      $form = $this->createForm(UsuarioType::class,$usuario);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
          // $form->getData() holds the submitted values
          // but, the original `$task` variable has also been updated
          //$task = $form->getData();

          $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
         $usuario->setPassword($password);
           $em = $this->getDoctrine()->getManager();
           $em->persist($usuario);
           $em->flush();
          $this->addFlash("Exito","Se ha modificado el usuario exitosamente.");
          return $this->redirectToRoute('usuario');
      }
          return $this->render('default/new.html.twig', array(
             'form' => $form->createView(),
         ));
    }
    /**
     * @Route("/usuario/delete/{id}", name="usuarioDelete")
     */
    public function eliminar($id){
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->find($id);
        if (!$usuario) {
            throw $this->createNotFoundException(
                'No se ha encontrado el usuario  '.$id
            );
        }
        $em->remove($usuario);
        $em->flush();
        $this->addFlash("Exito","Usuario eliminado correctamente.");
        return $this->redirectToRoute('usuario');
    }
}
