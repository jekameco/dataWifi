<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estudiantes
 *
 * @ORM\Table(name="estudiantes")
 * @ORM\Entity
 */
class Estudiantes
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEstudiante", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idestudiante;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $nombre = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="edad", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $edad = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="grado", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $grado = NULL;

    public function getIdestudiante(): ?int
    {
        return $this->idestudiante;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getGrado(): ?int
    {
        return $this->grado;
    }

    public function setGrado(?int $grado): self
    {
        $this->grado = $grado;

        return $this;
    }


}
