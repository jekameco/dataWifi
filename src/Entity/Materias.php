<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materias
 *
 * @ORM\Table(name="materias")
 * @ORM\Entity
 */
class Materias
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMateria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmateria;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreMateria", type="string", length=255, nullable=false)
     */
    private $nombremateria;

    public function getIdmateria(): ?int
    {
        return $this->idmateria;
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


}
