<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Pago;
use App\Entity\Compra;
use App\Entity\Proveedor;
use App\Entity\OC;
use App\Entity\Solped;

class SearchController extends Controller
{
    /**
     * @Route("/search/{search}", name="search")
     */
    public function index($search = null, Request $request)
    {
      if ($search != null){
        $em = $this->getDoctrine()->getRepository(Pago::class);
        $pagos = $em->getPagoBusqueda($search);
        $em = $this->getDoctrine()->getRepository(Compra::class);
        $compras = $em->getCompraBusqueda($search);
        $em = $this->getDoctrine()->getRepository(Solped::class);
        $solpeds = $em->getSolpedBusqueda($search);
        $em = $this->getDoctrine()->getRepository(OC::class);
        $ocs = $em->getOCBusqueda($search);

          return $this->render('default/search.html.twig',array(
            "solpeds" => $solpeds,
            "ocs" => $ocs,
            "pagos" => $pagos,
            "compras" => $compras,
          ));
      }else{
        throw $this->createNotFoundException('No se ha indicado nada');
      }

    }
}
