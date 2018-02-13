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
    * @ORM\ManyToMany(targetEntity="Compra", mappedBy="solpeds")
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



    /**
     * Get the value of Compras
     *
     * @return mixed
     */
    public function getCompras()
    {
        return $this->compras;
    }

    /**
     * Set the value of Compras
     *
     * @param mixed compras
     *
     * @return self
     */
    public function setCompras($compras)
    {
        $this->compras = $compras;

        return $this;
    }

    /**
     * Get the value of Pagos
     *
     * @return mixed
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    /**
     * Set the value of Pagos
     *
     * @param mixed pagos
     *
     * @return self
     */
    public function setPagos($pagos)
    {
        $this->pagos = $pagos;

        return $this;
    }
 

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}
