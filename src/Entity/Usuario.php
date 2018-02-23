<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 * @UniqueEntity(fields="username", message="Usuario ya existe.")
 */
class Usuario implements UserInterface
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    /**
    * @ORM\Column(type="string", length=255, unique=true)
    * @Assert\NotBlank();
    */
    private $username;

    /**
      * The below length depends on the "algorithm" you use for encoding
      * the password, but this works well with bcrypt.
      *
      * @ORM\Column(type="string", length=64)
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }
    public function getRoles()
      {
          return array('ROLE_USER');
      }
      public function eraseCredentials()
  {
  }
      /** @see \Serializable::serialize() */
         public function serialize()
         {
             return serialize(array(
                 $this->id,
                 $this->username,
                 $this->password,
                 $this->email,
                 $this->nombre,
                 // see section on salt below
                 // $this->salt,
             ));
         }

         /** @see \Serializable::unserialize() */
         public function unserialize($serialized)
         {
             list (
                 $this->id,
                 $this->username,
                 $this->password,
                 $this->email,
                 $this->nombre,
                 // see section on salt below
                 // $this->salt
             ) = unserialize($serialized);
         }


}
