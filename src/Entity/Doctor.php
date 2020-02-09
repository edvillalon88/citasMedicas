<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctorRepository")
 */
class Doctor
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
     * @ORM\OneToOne(targetEntity="User", inversedBy="doctor", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Especialidad", inversedBy="doctores")
     * @ORM\JoinColumn(name="especialidad_id", referencedColumnName="id") 
     */
    private $especialidad;

    /**
     * @ORM\ManyToOne(targetEntity="Consultorio", inversedBy="doctores")
     * @ORM\JoinColumn(name="consultorio_id", referencedColumnName="id") 
     */
    private $consultorio;

    /**
     * @ORM\ManyToOne(targetEntity="Secretaria", inversedBy="doctores")
     * @ORM\JoinColumn(name="secretaria_id", referencedColumnName="id") 
     */
    private $secretaria;

    /**
     * One Page has Many Housing.
     * @ORM\OneToMany(targetEntity="Cita", mappedBy="doctor")
     */
    private $citas;

    public function __construct()
    {
        $this->citas = new ArrayCollection();
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
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of especialidad
     */ 
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set the value of especialidad
     *
     * @return  self
     */ 
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get the value of consultorio
     */ 
    public function getConsultorio()
    {
        return $this->consultorio;
    }

    /**
     * Set the value of consultorio
     *
     * @return  self
     */ 
    public function setConsultorio($consultorio)
    {
        $this->consultorio = $consultorio;

        return $this;
    }

    /**
     * Get the value of secretaria
     */ 
    public function getSecretaria()
    {
        return $this->secretaria;
    }

    /**
     * Set the value of secretaria
     *
     * @return  self
     */ 
    public function setSecretaria($secretaria)
    {
        $this->secretaria = $secretaria;

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
}
