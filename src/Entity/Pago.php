<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Transaccion;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PagoRepository")
 */
class Pago extends Transaccion
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
    * @return Collection|Solped[]
    *
    * @ORM\ManyToMany(targetEntity="Solped", mappedBy="pagos")
    */
    private $solpeds;

    /**
    * @return Collection|OC[]
    *
    * @ORM\ManyToMany(targetEntity="OC", mappedBy="pagos")
    */
    private $ocs;

    public function __construct()
    {
        $this->solpeds = new ArrayCollection();
        $this->ocs = new ArrayCollection();
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
}
