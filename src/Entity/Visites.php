<?php

namespace App\Entity;

use App\Repository\VisitesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisitesRepository::class)
 */
class Visites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_utilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_object;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?string
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(string $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getIdObject(): ?string
    {
        return $this->id_object;
    }

    public function setIdObject(string $id_object): self
    {
        $this->id_object = $id_object;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
