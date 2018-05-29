<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PresidenteRepository")
 */
class Presidente
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
     * @ORM\Column(type="date")
     */
    private $fechanac;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Presidente", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $pais;

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

    public function getFechanac(): ?\DateTimeInterface
    {
        return $this->fechanac;
    }

    public function setFechanac(\DateTimeInterface $fechanac): self
    {
        $this->fechanac = $fechanac;

        return $this;
    }

    public function getPais(): ?self
    {
        return $this->pais;
    }

    public function setPais(self $pais): self
    {
        $this->pais = $pais;

        return $this;
    }
}
