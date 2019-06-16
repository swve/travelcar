<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reservations")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parking", inversedBy="reservations")
     */
    private $parking;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car", inversedBy="reservations")
     */
    private $car;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_start;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_end;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ParkingSpot", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spot;

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

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(?\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(?\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getSpot(): ?ParkingSpot
    {
        return $this->spot;
    }

    public function setSpot(?ParkingSpot $spot): self
    {
        $this->spot = $spot;

        return $this;
    }
}
