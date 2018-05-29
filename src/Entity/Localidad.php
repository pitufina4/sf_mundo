<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalidadRepository")
 */
class Localidad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="float")
     */
    private $area;

    /**
     * @ORM\Column(type="integer")
     */
    private $habitantes;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provincia", inversedBy="localidades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $provincia;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Monumento", mappedBy="localidad")
     */
    private $monumentos;

    public function __construct()
    {
        $this->monumentos = new ArrayCollection();
    }

    public function getId()
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

    public function getArea(): ?float
    {
        return $this->area;
    }

    public function setArea(float $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getHabitantes(): ?int
    {
        return $this->habitantes;
    }

    public function setHabitantes(int $habitantes): self
    {
        $this->habitantes = $habitantes;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * @return Collection|Monumento[]
     */
    public function getMonumentos(): Collection
    {
        return $this->monumentos;
    }

    public function addMonumento(Monumento $monumento): self
    {
        if (!$this->monumentos->contains($monumento)) {
            $this->monumentos[] = $monumento;
            $monumento->setLocalidad($this);
        }

        return $this;
    }

    public function removeMonumento(Monumento $monumento): self
    {
        if ($this->monumentos->contains($monumento)) {
            $this->monumentos->removeElement($monumento);
            // set the owning side to null (unless already changed)
            if ($monumento->getLocalidad() === $this) {
                $monumento->setLocalidad(null);
            }
        }

        return $this;
    }
}
