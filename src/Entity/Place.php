<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaceRepository")
 */
class Place
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Placetype", inversedBy="places")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parking", mappedBy="place")
     */
    private $parkings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AvailableSpot", mappedBy="place")
     */
    private $availableSpots;

    public function __construct()
    {
        $this->parkings = new ArrayCollection();
        $this->availableSpots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?placetype
    {
        return $this->type;
    }

    public function setType(?placetype $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|Parking[]
     */
    public function getParkings(): Collection
    {
        return $this->parkings;
    }

    public function addParking(Parking $parking): self
    {
        if (!$this->parkings->contains($parking)) {
            $this->parkings[] = $parking;
            $parking->setPlace($this);
        }

        return $this;
    }

    public function removeParking(Parking $parking): self
    {
        if ($this->parkings->contains($parking)) {
            $this->parkings->removeElement($parking);
            // set the owning side to null (unless already changed)
            if ($parking->getPlace() === $this) {
                $parking->setPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AvailableSpot[]
     */
    public function getAvailableSpots(): Collection
    {
        return $this->availableSpots;
    }

    public function addAvailableSpot(AvailableSpot $availableSpot): self
    {
        if (!$this->availableSpots->contains($availableSpot)) {
            $this->availableSpots[] = $availableSpot;
            $availableSpot->setPlace($this);
        }

        return $this;
    }

    public function removeAvailableSpot(AvailableSpot $availableSpot): self
    {
        if ($this->availableSpots->contains($availableSpot)) {
            $this->availableSpots->removeElement($availableSpot);
            // set the owning side to null (unless already changed)
            if ($availableSpot->getPlace() === $this) {
                $availableSpot->setPlace(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getTitle();
    }
}
