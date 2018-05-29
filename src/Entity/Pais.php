<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaisRepository")
 */
class Pais
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
     * @ORM\Column(type="string", length=50)
     */
    private $continente;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Region", mappedBy="pais")
     */
    private $regiones;

    public function __construct()
    {
        $this->regiones = new ArrayCollection();
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

    public function getContinente(): ?string
    {
        return $this->continente;
    }

    public function setContinente(string $continente): self
    {
        $this->continente = $continente;

        return $this;
    }

    /**
     * @return Collection|Region[]
     */
    public function getRegiones(): Collection
    {
        return $this->regiones;
    }

    public function addRegione(Region $regione): self
    {
        if (!$this->regiones->contains($regione)) {
            $this->regiones[] = $regione;
            $regione->setPais($this);
        }

        return $this;
    }

    public function removeRegione(Region $regione): self
    {
        if ($this->regiones->contains($regione)) {
            $this->regiones->removeElement($regione);
            // set the owning side to null (unless already changed)
            if ($regione->getPais() === $this) {
                $regione->setPais(null);
            }
        }

        return $this;
    }


     public function getArea(): ?float 
    {

        foreach ($this->regiones as $region) {
            $suma = $suma+$region->getArea();
        }
    return $suma;
    }


    public function getHabitantes(): ?int
    {

        foreach ($this->regiones as $region) {
            $suma = $suma+$region->getHabitantes();
        }
    return $suma;
    }
}
