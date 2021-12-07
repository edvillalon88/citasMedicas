<?php

namespace App\Entity;

use App\Repository\ClinicalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClinicalRepository::class)
 */
class Clinical
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logoUrl;
    

    /**
     * @ORM\Column(type="integer")
     */
    private $Telefono;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Url;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Longitud;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $TiempoPRomedio;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $HoraApertura;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $HoraCierre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->Telefono;
    }

    public function setTelefono(int $Telefono): self
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->Url;
    }

    public function setUrl(?string $Url): self
    {
        $this->Url = $Url;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->Latitude;
    }

    public function setLatitude(?float $Latitude): self
    {
        $this->Latitude = $Latitude;

        return $this;
    }

    public function getLongitud(): ?string
    {
        return $this->Longitud;
    }

    public function setLongitud(?string $Longitud): self
    {
        $this->Longitud = $Longitud;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getTiempoPRomedio(): ?int
    {
        return $this->TiempoPRomedio;
    }

    public function setTiempoPRomedio(int $TiempoPRomedio): self
    {
        $this->TiempoPRomedio = $TiempoPRomedio;

        return $this;
    }

    public function getHoraApertura(): ?\DateTimeInterface
    {
        return $this->HoraApertura;
    }

    public function setHoraApertura(?\DateTimeInterface $HoraApertura): self
    {
        $this->HoraApertura = $HoraApertura;

        return $this;
    }

    public function getHoraCierre(): ?\DateTimeInterface
    {
        return $this->HoraCierre;
    }

    public function setHoraCierre(?\DateTimeInterface $HoraCierre): self
    {
        $this->HoraCierre = $HoraCierre;

        return $this;
    }
}
