<?php

namespace App\Entity;

use App\Repository\ObjectsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjectsRepository::class)
 */
class Objects
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
    private $location;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $main_img;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img_3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getMainImg(): ?string
    {
        return $this->main_img;
    }

    public function setMainImg(?string $main_img): self
    {
        $this->main_img = $main_img;

        return $this;
    }

    public function getImg1(): ?string
    {
        return $this->img_1;
    }

    public function setImg1(?string $img_1): self
    {
        $this->img_1 = $img_1;

        return $this;
    }

    public function getImg2(): ?string
    {
        return $this->img_2;
    }

    public function setImg2(?string $img_2): self
    {
        $this->img_2 = $img_2;

        return $this;
    }

    public function getImg3(): ?string
    {
        return $this->img_3;
    }

    public function setImg3(?string $img_3): self
    {
        $this->img_3 = $img_3;

        return $this;
    }
}
