<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    /**
    * @Route("/menulist",name="menuList")
    */
    public function list(){
      $urls[] = array("url" => "welcome","title" => "Inicio");
      $urls[] = array("drop" => array(
            array("url" => "usuario","title" => "Listar Usuarios"),
            array("url" => "usuarioNuevo","title" => "Crear nuevo usuario")
      ), "title" => "Usuarios");
      $urls[] = array("drop" => array(
            array("url" => "proveedor","title" => "Listar Proveedores"),
            array("url" => "proveedorNuevo","title" => "Crear nuevo proveedor")
      ), "title" => "Proveedores");
      $urls[] = array("drop" => array(
          array("url" => "compra","title" => "Listar Compras"),
          array("url" => "compraNuevo","title" => "Crear nueva compra"),
      ), "title" => "Compras");
      $urls[] = array("drop" => array(
          array("url" => "pago","title" => "Listar Pagos"),
          array("url" => "pagoNuevo","title" => "Crear nuevo pago"),
      ), "title" => "Pagos");
      return $this->render(
            'default/parts/header.html.twig',
            array('urls' => $urls)
        );
    }
}
