<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DistribucionRepository")
 */
class Distribucion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
    * @ORM\Column(type="boolean")
    */
    private $tipo;
    /**
    * @ORM\Column(type="integer")
    */
    private $cantidad;
    /**
    * @ORM\Column(type="string", length=6,nullable=false)
    */
    private $ceco;
    /**
    * @ORM\Column(type="string", length=6,nullable=false)
    */
    private $cuenta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compra", inversedBy="detalle")
     * @ORM\JoinColumn(nullable=true)
     */
    private $compra;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pago", inversedBy="detalle")
     * @ORM\JoinColumn(nullable=true)
     */
    private $pago;


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
     * Get the value of Ceco
     *
     * @return mixed
     */
    public function getCeco()
    {
        return $this->ceco;
    }

    /**
     * Set the value of Ceco
     *
     * @param mixed ceco
     *
     * @return self
     */
    public function setCeco($ceco)
    {
        $this->ceco = $ceco;

        return $this;
    }

    /**
     * Get the value of Cuenta
     *
     * @return mixed
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * Set the value of Cuenta
     *
     * @param mixed cuenta
     *
     * @return self
     */
    public function setCuenta($cuenta)
    {
        $this->cuenta = $cuenta;

        return $this;
    }




    /**
     * Get the value of Cantidad
     *
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of Cantidad
     *
     * @param mixed cantidad
     *
     * @return self
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }




    /**
     * Get the value of Compra
     *
     * @return mixed
     */
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * Set the value of Compra
     *
     * @param mixed compra
     *
     * @return self
     */
    public function setCompra($compra)
    {
        $this->compra = $compra;

        return $this;
    }

    /**
     * Get the value of Pago
     *
     * @return mixed
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * Set the value of Pago
     *
     * @param mixed pago
     *
     * @return self
     */
    public function setPago($pago)
    {
        $this->pago = $pago;

        return $this;
    }

}
