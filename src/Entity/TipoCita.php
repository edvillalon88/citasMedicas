<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipoCitaRepository")
 */
class TipoCita
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**     
     * @ORM\Column(name="nombre", type="string", length=200, unique=true) 
     */
    private $nombre;

    /**
     * One Page has Many Housing.
     * @ORM\OneToMany(targetEntity="Cita", mappedBy="tipo")
     */
    private $citas;

    /**
     * Get the value of id
     *
     * @return  \Ramsey\Uuid\UuidInterface
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  \Ramsey\Uuid\UuidInterface  $id
     *
     * @return  self
     */ 
    public function setId(\Ramsey\Uuid\UuidInterface $id)
    {
        $this->id = $id;

        return $this;
    }

    

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function __toString()
    {
       return  $this->getNombre();
    } 
}
