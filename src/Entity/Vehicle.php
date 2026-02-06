<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $year = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $weight = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_created = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $model_3d_Path = null;

    /**
     * @var Collection<int, ReservationRequest>
     */
    #[ORM\OneToMany(targetEntity: ReservationRequest::class, mappedBy: 'vehicle')]
    private Collection $reservationRequests;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brand = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fuel $fuel = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?vehicleTransmission $transmission = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VehicleStatus $status = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Condition $condition = null;

    /**
     * @var Collection<int, VehicleImage>
     */
    #[ORM\OneToMany(targetEntity: VehicleImage::class, mappedBy: 'vehicle', orphanRemoval: true)]
    private Collection $image;

    public function __construct()
    {
        $this->reservationRequests = new ArrayCollection();
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getYear(): ?\DateTimeImmutable
    {
        return $this->year;
    }

    public function setYear(\DateTimeImmutable $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeImmutable
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeImmutable $date_created): static
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getModel3dPath(): ?string
    {
        return $this->model_3d_Path;
    }

    public function setModel3dPath(?string $model_3d_Path): static
    {
        $this->model_3d_Path = $model_3d_Path;

        return $this;
    }

    /**
     * @return Collection<int, ReservationRequest>
     */
    public function getReservationRequests(): Collection
    {
        return $this->reservationRequests;
    }

    public function addReservationRequest(ReservationRequest $reservationRequest): static
    {
        if (!$this->reservationRequests->contains($reservationRequest)) {
            $this->reservationRequests->add($reservationRequest);
            $reservationRequest->setVehicle($this);
        }

        return $this;
    }

    public function removeReservationRequest(ReservationRequest $reservationRequest): static
    {
        if ($this->reservationRequests->removeElement($reservationRequest)) {
            // set the owning side to null (unless already changed)
            if ($reservationRequest->getVehicle() === $this) {
                $reservationRequest->setVehicle(null);
            }
        }

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getFuel(): ?Fuel
    {
        return $this->fuel;
    }

    public function setFuel(?Fuel $fuel): static
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getTransmission(): ?vehicleTransmission
    {
        return $this->transmission;
    }

    public function setTransmission(?vehicleTransmission $transmission): static
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getStatus(): ?VehicleStatus
    {
        return $this->status;
    }

    public function setStatus(?VehicleStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCondition(): ?Condition
    {
        return $this->condition;
    }

    public function setCondition(?Condition $condition): static
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * @return Collection<int, VehicleImage>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(VehicleImage $image): static
    {
        if (!$this->image->contains($image)) {
            $this->image->add($image);
            $image->setVehicle($this);
        }

        return $this;
    }

    public function removeImage(VehicleImage $image): static
    {
        if ($this->image->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVehicle() === $this) {
                $image->setVehicle(null);
            }
        }

        return $this;
    }
}
