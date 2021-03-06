<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\PagoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Pago
{
  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="pagos")
   * @ORM\JoinColumn(nullable=true)
   */
    private $usuario;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
    * @ORM\Column(type="string")
    */
    private $factura;
    /**
    * @return Collection|Solped[]
    *
    * @ORM\ManyToMany(targetEntity="Solped", inversedBy="pagos")
    */
    private $solpeds;

    /**
    * @return Collection|OC[]
    *
    * @ORM\ManyToMany(targetEntity="OC", inversedBy="pagos")
    */
    private $ocs;
    /**
    * @ORM\Column(type="text")
    */
    private $descripcion;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proveedor", inversedBy="pagos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $proveedor;
    /**
    * @ORM\Column(type="integer")
    */
    private $estado;
    /**
    * @ORM\Column(type="integer")
    */
    private $tipo;


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
          return "Envio HES";
          break;

        case 2:
          return "Redistribuir";
          break;

        case 3:
          return "Finalizado";
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
     * @ORM\OneToMany(targetEntity="App\Entity\Detalle", mappedBy="pago")
     * @ORM\JoinColumn(name="pago_id",nullable=true)
     */
    private $detalle;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Distribucion", mappedBy="pago")
     * @ORM\JoinColumn(name="pago_id",nullable=true)
     */
    private $distribucion;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attachment", mappedBy="pago")
     * @ORM\JoinColumn(name="pago_id",nullable=true)
     */
    private $attachments;


    /**
     * Get the value of Detalle
     *
     * @return mixed
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set the value of Detalle
     *
     * @param mixed detalle
     *
     * @return self
     */
    public function addDetalle($detalle)
    {
      if ($this->detalle->contains($detalle)){
        return;
      }
      $this->detalle->add($detalle);
      $detalle->setPago($this);

        return $this;
    }
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
        $this->solpeds = new ArrayCollection();
        $this->ocs = new ArrayCollection();
        $this->detalle = new ArrayCollection();
        $this->attachments = new ArrayCollection();
    }
    public function addSolped(Solped $solped)
    {
      if ($this->solpeds->contains($solped)) {
          return;
      }
      $this->solpeds->add($solped);
      $solped->addPago($this);
    }
    public function addOc(OC $oc)
    {
      if ($this->ocs->contains($oc)){
        return;
      }
      $this->ocs->add($oc);
      $oc->addPago($this);
    }

    public function addAttachment(Attachment $attachment){
      if ($this->attachments->contains($attachment)){
        return;
      }
      $this->attachments->add($attachment);
      $attachment->setPago($this);
    }

    /**
     * Get the value of Usuario
     *
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of Usuario
     *
     * @param mixed usuario
     *
     * @return self
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

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
     * Get the value of Solpeds
     *
     * @return mixed
     */
    public function getSolpeds()
    {
        return $this->solpeds;
    }

    /**
     * Set the value of Solpeds
     *
     * @param mixed solpeds
     *
     * @return self
     */
    public function setSolpeds($solpeds)
    {
        $this->solpeds = $solpeds;

        return $this;
    }

    /**
     * Get the value of Ocs
     *
     * @return mixed
     */
    public function getOcs()
    {
        return $this->ocs;
    }

    /**
     * Set the value of Ocs
     *
     * @param mixed ocs
     *
     * @return self
     */
    public function setOcs($ocs)
    {
        $this->ocs = $ocs;

        return $this;
    }

    /**
     * Get the value of Descripcion
     *
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of Descripcion
     *
     * @param mixed descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of Proveedor
     *
     * @return mixed
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set the value of Proveedor
     *
     * @param mixed proveedor
     *
     * @return self
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

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
     * Get the value of Tipo
     *
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of Tipo
     *
     * @param mixed tipo
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

        /**
         * Get the value of Distribucion
         *
         * @return mixed
         */
        public function getDistribucion()
        {
            return $this->distribucion;
        }

        /**
         * Set the value of Distribucion
         *
         * @param mixed distribucion
         *
         * @return self
         */
        public function setDistribucion($distribucion)
        {
            $this->distribucion = $distribucion;

            return $this;
        }
        public function addDistribucion($distribucion)
        {
          if ($this->distribucion->contains($distribucion)){
            return;
          }
          $this->distribucion->add($distribucion);
          $distribucion->setPago($this);

            return $this;
        }
        /**
         * Get the value of Attachments
         *
         * @return mixed
         */
        public function getAttachments()
        {
            return $this->attachments;
        }

        /**
         * Set the value of Attachments
         *
         * @param mixed attachments
         *
         * @return self
         */
        public function setAttachments($attachments)
        {
            $this->attachments = $attachments;

            return $this;
        }



    /**
     * Get the value of Factura
     *
     * @return mixed
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set the value of Factura
     *
     * @param mixed factura
     *
     * @return self
     */
    public function setFactura($factura)
    {
        $this->factura = $factura;

        return $this;
    }

}
