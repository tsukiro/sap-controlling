<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 * @UniqueEntity(fields="username", message="Usuario ya existe.")
 */
class Usuario
{
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Compra", mappedBy="usuario")
    * @ORM\JoinColumn(nullable=true)
    */
    private $compras;


    /**
     * @return Collection|Compra[]
     */
    public function getCompras()
    {
        return $this->compras;
    }
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Pago", mappedBy="usuario")
    * @ORM\JoinColumn(nullable=true)
    */
    private $pagos;
    /**
     * @return Collection|Pago[]
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    public function __Construct(){
      $this->compras = new ArrayCollection();
      $this->pagos = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="string",nullable=false)
    */
    private $nombre;

    /**
    * @ORM\Column(type="string",unique=true)
    * @Assert\NotBlank();
    */
    private $username;

    /**
    * @ORM\Column(type="string",nullable=false)
    */
    private $password;



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

    /**
     * Get the value of Username
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of Username
     *
     * @param mixed username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

}
