<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OCRepository")
 * @ORM\HasLifecycleCallbacks
 */
class OC
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
    * @ORM\ManyToMany(targetEntity="Pago", mappedBy="ocs")
    */
    private $pagos;
    /**
    * @ORM\Column(type="string")
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
   /**
   * @ORM\Column(type="integer")
   */
   private $estado;

   /**
   * @ORM\Column(type="text", nullable=true)
   */
   private $observacion;

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
    public function addPago($pago)
    {
        $this->pagos[] = $pago;

        return $this;
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
     * Get the value of Created
     *
     * @return datetime $created
     */
    public function getCreated()
    {
        return $this->created;
    }



    /**
     * Get the value of Estado
     *
     * @return mixed
     */
    public function getEstado()
    {
      switch ($this->estado) {
        case 0:
          return "Pendiente";
          break;

        case 1:
          return "Enviado a Proveedor";
          break;
        case 2:
            return "Finalizado";
          break;
        case 3:
            return "Anulado";
          break;
      }
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
     * Get the value of Observacion
     *
     * @return mixed
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set the value of Observacion
     *
     * @param mixed observacion
     *
     * @return self
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

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
