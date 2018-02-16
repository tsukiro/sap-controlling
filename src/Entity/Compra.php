<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Transaccion;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompraRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Compra
{
  /**
   * Muchas compras pueden tener muchas solpeds
   * Muchas compras pueden tener muchas ocs
   * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="compras")
   * @ORM\JoinColumn(nullable=true)
   */
    private $usuario;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    public function getId(){
      return $this->id;
    }
    /**
    * @return Collection|Solped[]
    *
    * @ORM\ManyToMany(targetEntity="Solped", inversedBy="compras")
    */
    private $solpeds;

    /**
    * @return Collection|OC[]
    *
    * @ORM\ManyToMany(targetEntity="OC", inversedBy="compras")
    */
    private $ocs;
    /**
    * @ORM\Column(type="text")
    */
    private $descripcion;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proveedor", inversedBy="compras")
     * @ORM\JoinColumn(nullable=true)
     */
    private $proveedor;

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
    * @ORM\Column(type="string")
    */
    private $solicitante;

    /**
    * @ORM\Column(type="integer")
    */
    private $tipo;
    public function __construct()
    {
        $this->solpeds = new ArrayCollection();
        $this->ocs = new ArrayCollection();
    }
    public function getSolpeds(){
      return $this->solpeds;
    }
    public function getOcs(){
      return $this->ocs;
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

    public function addSolped(Solped $solped)
    {
      if ($this->solpeds->contains($solped)) {
          return;
      }
      $this->solpeds->add($solped);
      $solped->addCompra($this);
    }
    public function addOc(OC $oc)
    {
      if ($this->ocs->contains($oc)){
        return;
      }
      $this->ocs->add($oc);
      $oc->addCompra($this);
    }

    /**
     * Get the value of Tipo
     *
     * @return mixed
     */
    public function getTipo()
    {
        switch ($this->tipo) {
          case 0:
            return "Material";
            break;

          case 1:
            return "Servicio";
            break;
        }

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

    /**
     * Get the value of Solicitante
     *
     * @return mixed
     */
    public function getSolicitante()
    {
        return $this->solicitante;
    }

    /**
     * Set the value of Solicitante
     *
     * @param mixed solicitante
     *
     * @return self
     */
    public function setSolicitante($solicitante)
    {
        $this->solicitante = $solicitante;

        return $this;
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
      switch ($this->estado) {
        case 0:
            return "Pendiente";
          break;

        case 1:
          return "OC Enviada";
          break;

        case 2:
          return "Anulada";
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
}
