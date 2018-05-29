<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
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
     * @ORM\Column(type="string", length=100)
     */
    private $idioma;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Provincia", mappedBy="region")
     */
    private $provincias;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pais", inversedBy="regiones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pais;

    public function __construct()
    {
        $this->provincias = new ArrayCollection();
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

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(string $idioma): self
    {
        $this->idioma = $idioma;

        return $this;
    }

    /**
     * @return Collection|Provincia[]
     */
    public function getProvincias(): Collection
    {
        return $this->provincias;
    }

    public function addProvincia(Provincia $provincia): self
    {
        if (!$this->provincias->contains($provincia)) {
            $this->provincias[] = $provincia;
            $provincia->setRegion($this);
        }

        return $this;
    }

    public function removeProvincia(Provincia $provincia): self
    {
        if ($this->provincias->contains($provincia)) {
            $this->provincias->removeElement($provincia);
            // set the owning side to null (unless already changed)
            if ($provincia->getRegion() === $this) {
                $provincia->setRegion(null);
            }
        }

        return $this;
    }

    public function getPais(): ?Pais
    {
        return $this->pais;
    }

    public function setPais(?Pais $pais): self
    {
        $this->pais = $pais;

        return $this;
    }



    public function getArea(): ?float 
    {

        foreach ($this->provincias as $provincia) {
            $suma = $suma+$provincia->getArea();
        }
    return $suma;
    }


    public function getHabitantes(): ?int
    {

        foreach ($this->provincias as $provincia) {
            $suma = $suma+$provincia->getHabitantes();
        }
    return $suma;
    }

}
