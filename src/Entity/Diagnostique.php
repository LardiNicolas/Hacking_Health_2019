<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagnostique
 *
 * @ORM\Table(name="DIAGNOSTIQUE", indexes={@ORM\Index(name="idPhoto", columns={"idPhoto"})})
 * @ORM\Entity
 */
class Diagnostique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostique", type="string", length=30, nullable=false)
     */
    private $diagnostique;

    /**
     * @var \Photo
     *
     * @ORM\ManyToOne(targetEntity="Photo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPhoto", referencedColumnName="idPhoto")
     * })
     */
    private $idphoto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiagnostique(): ?string
    {
        return $this->diagnostique;
    }

    public function setDiagnostique(string $diagnostique): self
    {
        $this->diagnostique = $diagnostique;

        return $this;
    }

    public function getIdphoto(): ?Photo
    {
        return $this->idphoto;
    }

    public function setIdphoto(?Photo $idphoto): self
    {
        $this->idphoto = $idphoto;

        return $this;
    }


}
