<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nomphoto
 *
 * @ORM\Table(name="NOMPHOTO", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Nomphoto
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nom;

    /**
     * @var \Photo
     *
     * @ORM\ManyToOne(targetEntity="Photo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="idPhoto")
     * })
     */
    private $id;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function getId(): ?Photo
    {
        return $this->id;
    }

    public function setId(?Photo $id): self
    {
        $this->id = $id;

        return $this;
    }


}
