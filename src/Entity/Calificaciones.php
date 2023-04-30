<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calificaciones
 *
 * @ORM\Table(name="calificaciones")
 * @ORM\Entity
 */
class Calificaciones
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCalificaciones", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcalificaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaRegistro", type="date", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreEstudiante", type="string", length=255, nullable=false)
     */
    private $nombreestudiante;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreMateria", type="string", length=255, nullable=false)
     */
    private $nombremateria;

    /**
     * @var string
     *
     * @ORM\Column(name="CalificacionFinal", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $calificacionfinal;

    public function getIdcalificaciones(): ?int
    {
        return $this->idcalificaciones;
    }

    public function getFecharegistro(): ?\DateTimeInterface
    {
        return $this->fecharegistro;
    }

    public function setFecharegistro(\DateTimeInterface $fecharegistro): self
    {
        $this->fecharegistro = $fecharegistro;

        return $this;
    }

    public function getNombreestudiante(): ?string
    {
        return $this->nombreestudiante;
    }

    public function setNombreestudiante(?string $nombreestudiante ): self
    {
        $this->nombreestudiante = $nombreestudiante;

        return $this;
    }

    public function getNombremateria(): ?string
    {
        return $this->nombremateria;
    }

    public function setNombremateria(string $nombremateria): self
    {
        $this->nombremateria = $nombremateria;

        return $this;
    }

    public function getCalificacionfinal(): ?string
    {
        return $this->calificacionfinal;
    }

    public function setCalificacionfinal(string $calificacionfinal): self
    {
        $this->calificacionfinal = $calificacionfinal;

        return $this;
    }

    public function __toString()
{
    return $this->nombreestudiante . ' ' . $this->nombremateria . ' ' . $this->calificacionfinal . ' ' . $this->fecharegistro;
}


}
