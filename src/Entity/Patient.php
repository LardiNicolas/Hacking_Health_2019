<?php

namespace App\Entity;

use App\Entity\Photo;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Patient
 *
 * @ORM\Table(name="PATIENT", indexes={@ORM\Index(name="IPATIENT", columns={"id"})})
 * @ORM\Entity
 */
class Patient
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
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=false)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=false)
     */
    private $datenaissance;

//    /**
//     * @var \DateTime|null
//     *
//     * @ORM\Column(name="lastUpdate", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
//     */
//    private $lastupdate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="lastUpdate", type="date", nullable=true)
     */
    private $lastupdate;

    /**
    * @ORM\OneToMany(targetEntity="Photo", cascade={"persist", "remove"}, mappedBy="id")
    */
    private $photos;

    public function __construct(){
        $this->photos = new ArrayCollection();

        $this->getLastupdate(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getLastupdate()
    {
        return $this->lastupdate;
    }

    public function setLastupdate($lastupdate): self
    {
        $this->lastupdate = $lastupdate;

        return $this;
    }

    public function getPhotos()
    {
        return $this->photos;
    }

    public function addPhoto(\App\Entity\Photo $photos)
    {
        $this->photos->add($photos);
        $photos->setQuestion($this);
    }
}
