<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EspecialidadRepository")
 */
class Especialidad
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
     * @ORM\Column(name="nombre", type="string", length=200) 
     */
    private $nombre;

    /**
     * One Page has Many Housing.
     * @ORM\OneToMany(targetEntity="Doctor", mappedBy="especialidad", cascade={"remove"})
     */
    protected $doctores;  

    public function __construct()
    {
        $this->doctores = new ArrayCollection();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @return  self
     */ 
    public function setNombre($Nombre)
    {
        $this->nombre = $Nombre;

        return $this;
    }

    /**
     * Get one Page has Many Housing.
     */ 
    public function getDoctores()
    {
        return $this->doctores;
    }

    /**
     * Set one Page has Many Housing.
     *
     * @return  self
     */ 
    public function setDoctores($doctores)
    {
        $this->doctores = $doctores;

        return $this;
    }
    public function __toString()
    {
        return $this->nombre;
    }
}
