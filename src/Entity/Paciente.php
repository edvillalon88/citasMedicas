<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PacienteRepository")
 */
class Paciente
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @Type("string")
     */
    private $id;

    /**     
     * @ORM\Column(name="nombre", type="string", length=200) 
     */
    private $nombre;

    /**     
     * @ORM\Column(name="apellidos", type="string", length=200) 
     */
    private $apellidos;

    /**     
     * @ORM\Column(name="correo", type="string", length=100, nullable=true) 
     */
    private $correo;

    /**     
     * @ORM\Column(name="fecha_registro", type="datetime") 
     */
    private $fechaRegistro;

    /**
     * One Page has Many Housing.
     * @ORM\OneToMany(targetEntity="Cita", mappedBy="doctor")
     */
    private $citas;

    public function __construct()
    {
        $this->setFechaRegistro(new \DateTime());
        $this->citas = new ArrayCollection();
    }

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
    public function setId($id)
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

    /**
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of fechaRegistro
     */ 
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set the value of fechaRegistro
     *
     * @return  self
     */ 
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get one Page has Many Housing.
     */ 
    public function getCitas()
    {
        return $this->citas;
    }

    /**
     * Set one Page has Many Housing.
     *
     * @return  self
     */ 
    public function setCitas($citas)
    {
        $this->citas = $citas;

        return $this;
    }

    public function __toString()
    {
        return $this->nombre." ".$this->apellidos;
    }
}
