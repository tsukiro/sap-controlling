<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetalleRepository")
 */
class Detalle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
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
     * @ORM\Column(type="integer")
     */

    private $tipo;
    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad;
    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;
    /**
     * @ORM\Column(type="string",length=3)
     */
    private $medida;
    /**
     * @ORM\Column(type="string",length=1)
     */
    private $tiempo;
    /**
     * @ORM\Column(type="decimal",scale=2)
     */
    private $valor;





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
     * Get the value of Medida
     *
     * @return mixed
     */
    public function getMedida()
    {
        return $this->medida;
    }

    /**
     * Set the value of Medida
     *
     * @param mixed medida
     *
     * @return self
     */
    public function setMedida($medida)
    {
        $this->medida = $medida;

        return $this;
    }

    /**
     * Get the value of Tiempo
     *
     * @return mixed
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set the value of Tiempo
     *
     * @param mixed tiempo
     *
     * @return self
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get the value of Valor
     *
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of Valor
     *
     * @param mixed valor
     *
     * @return self
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

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
