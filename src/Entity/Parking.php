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
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="parkings")
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="parking")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Parkreview", mappedBy="parking")
     */
    private $parkreviews;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->availableSpots = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->parkreviews = new ArrayCollection();
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

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setParking($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getParking() === $this) {
                $reservation->setParking(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Parkreview[]
     */
    public function getParkreviews(): Collection
    {
        return $this->parkreviews;
    }

    public function addParkreview(Parkreview $parkreview): self
    {
        if (!$this->parkreviews->contains($parkreview)) {
            $this->parkreviews[] = $parkreview;
            $parkreview->setParking($this);
        }

        return $this;
    }

    public function removeParkreview(Parkreview $parkreview): self
    {
        if ($this->parkreviews->contains($parkreview)) {
            $this->parkreviews->removeElement($parkreview);
            // set the owning side to null (unless already changed)
            if ($parkreview->getParking() === $this) {
                $parkreview->setParking(null);
            }
        }

        return $this;
    }
}
