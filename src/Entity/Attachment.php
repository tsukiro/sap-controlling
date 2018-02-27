<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttachmentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Attachment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
    * @ORM\Column(type="string")
    */
    private $nombre;
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
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "application/pdf","application/msword","application/excel","application/vnd.ms-excel","text/plain","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.openxmlformats-officedocument.presentationml.presentation" })
     */
    private $brochure;


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
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * Get the value of Brochure
     *
     * @return mixed
     */
    public function getBrochure()
    {
        return $this->brochure;
    }

    /**
     * Set the value of Brochure
     *
     * @param mixed brochure
     *
     * @return self
     */
    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

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
