<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecretariaRepository")
 */
class Secretaria
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
     * @ORM\OneToOne(targetEntity="User", inversedBy="secretaria", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $usuario;

    /**
     * One Page has Many Housing.
     * @ORM\OneToMany(targetEntity="Doctor", mappedBy="secretaria")
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
        return $this->usuario->username;
    }
}
