<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use Intervention\Image\ImageManagerStatic as Image;


class AvatarImageController extends Controller
{
    /**
     * @Route("/image/{name}.{_format}", name="image")
     */
    public function index($name)
    {


      $avatar = new InitialAvatar();
      // create an image manager instance with favored driver
      Image::configure(array('driver' => 'imagick'));
      $image = $avatar->name($name)
          ->length(2)
          ->fontSize(0.5)
          ->size(96) // 48 * 2
          ->background('#8BC34A')
          ->color('#fff')
          ->generate()
          ->stream('png', 100);
      // to finally create image instances
      $image = Image::make($image);
      //$response = Image::make($image->encode('png'));
      $response = new response($image->response());
      $response->headers->set('Content-Type', 'image/png');
      // set content-type
      //$response->header('Content-Type', 'image/png');
      return $response;
    }
}
