<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MenuController
{
    /**
    * @Route("/menulist",name="menuList")
    */
    public function list(){
      $urls[] = array("url" => "welcome","title" => "Inicio");
      $urls[] = array("url" => "usuario","title" => "Listar Usuarios");
      $urls[] = array("url" => "usuarioNuevo","title" => "Crear nuevo usuario");
      
      return $urls;
    }
}
