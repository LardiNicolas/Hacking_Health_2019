<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prediagnostique
 *
 * @ORM\Table(name="PREDIAGNOSTIQUE", indexes={@ORM\Index(name="idPhoto", columns={"idPhoto"})})
 * @ORM\Entity
 */
class Prediagnostique
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
     * @ORM\Column(name="prediagnostique", type="string", length=30, nullable=false)
     */
    private $prediagnostique;

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

    public function getPrediagnostique(): ?string
    {
        return $this->prediagnostique;
    }

    public function setPrediagnostique(string $prediagnostique): self
    {
        $this->prediagnostique = $prediagnostique;

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
