<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParkreviewRepository")
 */
class Parkreview
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="parkreviews")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\parking", inversedBy="parkreviews")
     */
    private $parking;

    /**
     * @ORM\Column(type="integer")
     */
    private $starts;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getParking(): ?parking
    {
        return $this->parking;
    }

    public function setParking(?parking $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function getStarts(): ?int
    {
        return $this->starts;
    }

    public function setStarts(int $starts): self
    {
        $this->starts = $starts;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
