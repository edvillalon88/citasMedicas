<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CitaRepository")
 */
class Cita
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
     * @ORM\Column(name="fecha_hora", type="datetime") 
     */
    private $fechaHora;

    /**
     * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="citas")
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id") 
     */
    private $doctor;

    /**
     * @ORM\ManyToOne(targetEntity="paciente", inversedBy="citas")
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id") 
     */
    private $paciente;

    /**
     * @var text
     * @ORM\Column(name="descripcion", type="text")
     */
    protected $descripcion;     

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
     * Get the value of fechaHora
     */ 
    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    /**
     * Set the value of fechaHora
     *
     * @return  self
     */ 
    public function setFechaHora($fechaHora)
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }

    /**
     * Get the value of doctor
     */ 
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * Set the value of doctor
     *
     * @return  self
     */ 
    public function setDoctor($doctor)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get the value of paciente
     */ 
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set the value of paciente
     *
     * @return  self
     */ 
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;

        return $this;
    }
}
