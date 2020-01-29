<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlannedTripRepository")
 */
class PlannedTrip
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
    private $date;

    /**
     * @var TripPoint[]
     * @ORM\OneToMany(targetEntity="App\Entity\TripPoint", mappedBy="trip")
     */
    private $points;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    public function __construct()
    {
        $this->points = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|TripPoint[]
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(TripPoint $point): self
    {
        if (!$this->points->contains($point)) {
            $this->points[] = $point;
            $point->setTrip($this);
        }

        return $this;
    }

    public function removePoint(TripPoint $point): self
    {
        if ($this->points->contains($point)) {
            $this->points->removeElement($point);
        }

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

    public function toArray() {
        $points = [];
        foreach($this->points as $point) {
            $points []= $point->toArray();
        }
        return [
            "id" => $this->id,
            "date" => $this->date,
            "city" => $this->city,
            "points" => $points,
        ];
    }
}
