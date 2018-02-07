<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ProveedorRepository")
 */
class Proveedor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
    * @ORM\Column(type="text",length=20)
    */
    private $rut;
    /**
    * @ORM\Column(type="string")
    */
    private $nombre;
    /**
    * @return Collection|Compra[]
    *
    * @ORM\OneToMany(targetEntity="Compra", mappedBy="proveedor")
    */
    private $compras;

    public function __Construct(){
      $this->compras = new ArrayCollection();
    }
    public function getCompras(){
      return $this->compras;
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
     * Get the value of Rut
     *
     * @return mixed
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set the value of Rut
     *
     * @param mixed rut
     *
     * @return self
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get the value of Nombre
     *
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @param mixed nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

}
