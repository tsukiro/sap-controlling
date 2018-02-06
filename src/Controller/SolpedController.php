<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SolpedController extends Controller
{
    /**
     * @Route("/solped", name="solped")
     */
    public function index()
    {
        return new Response('Welcome to your new controller!');
    }
}
