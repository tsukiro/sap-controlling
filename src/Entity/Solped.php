<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SolpedRepository")
 */
class Solped
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @return Collection|Compra[]
    *
    * @ORM\ManyToMany(targetEntity="Compra", mappedBy="ocs")
    */
    private $compras;
    /**
    * @return Collection|Pago[]
    *
    * @ORM\ManyToMany(targetEntity="Pago", mappedBy="pagos")
    */
    private $pagos;

    public function __construct()
    {
        $this->compras = new ArrayCollection();
        $this->pagos = new ArrayCollection();
    }
}
