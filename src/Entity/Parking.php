<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParkingRepository")
 */
class Parking
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
     * @ORM\ManyToOne(targetEntity="App\Entity\place", inversedBy="parkings")
     */
    private $place;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cars", mappedBy="parking")
     */
    private $cars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AvailableSpot", mappedBy="parking")
     */
    private $availableSpots;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
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

    public function getPlace(): ?place
    {
        return $this->place;
    }

    public function setPlace(?place $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Cars[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Cars $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setParking($this);
        }

        return $this;
    }

    public function removeCar(Cars $car): self
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getParking() === $this) {
                $car->setParking(null);
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
            $availableSpot->setParking($this);
        }

        return $this;
    }

    public function removeAvailableSpot(AvailableSpot $availableSpot): self
    {
        if ($this->availableSpots->contains($availableSpot)) {
            $this->availableSpots->removeElement($availableSpot);
            // set the owning side to null (unless already changed)
            if ($availableSpot->getParking() === $this) {
                $availableSpot->setParking(null);
            }
        }

        return $this;
    }
}
