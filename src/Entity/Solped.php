<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity(repositoryClass="App\Repository\SolpedRepository")
* @ORM\HasLifecycleCallbacks
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
    * @ORM\ManyToMany(targetEntity="Pago", mappedBy="solpeds")
    */
    private $pagos;
    /**
    * @ORM\Column(type="integer")
    */
    private $numero;
    /**
    * @var datetime $created
    *
    * @ORM\Column(type="datetime")
    */
   protected $created;
   /**
    * Gets triggered only on insert

    * @ORM\PrePersist
    */
   public function onPrePersist()
   {
       $this->created = new \DateTime("now");
   }
    public function __construct()
    {
        $this->compras = new ArrayCollection();
        $this->pagos = new ArrayCollection();
    }
    /**
    * @ORM\Column(type="integer")
    */
    private $estado;


    /**
     * Get the value of Estado
     *
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of Estado
     *
     * @param mixed estado
     *
     * @return self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
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
     public function addCompra($compra)
     {
         $this->compras[] = $compra;

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


    /**
     * Get the value of Numero
     *
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of Numero
     *
     * @param mixed numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }
    /**
     * Get the value of created
     *
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @param mixed created
     *
     * @return self
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }
}
