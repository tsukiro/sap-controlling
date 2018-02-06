<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransaccionRepository")
 */
class Transaccion
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields

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
    * @ORM\Column(type="integer")
    */
    private $estado;

    /**
    * @ORM\Column(type="datetime")
    */
    private $fecha;


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
     * Get the value of Fecha
     *
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of Fecha
     *
     * @param mixed fecha
     *
     * @return self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

  


}
