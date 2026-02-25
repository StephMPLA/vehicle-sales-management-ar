<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Enum\VehicleImageType;
use App\Repository\VehicleImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get()
    ],
    normalizationContext: ['groups' => ['vehicle:read']]
)]

#[ORM\Entity(repositoryClass: VehicleImageRepository::class)]
class VehicleImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['vehicle:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['vehicle:read'])]
    private ?string $path = null;

    #[ORM\Column(enumType: VehicleImageType::class)]
    private VehicleImageType $type;

    #[ORM\ManyToOne(targetEntity: Vehicle::class, inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicle $vehicle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = trim($path);

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): static
    {
        $this->vehicle = $vehicle;

        return $this;
    }
    public function getType(): VehicleImageType
    {
        return $this->type;
    }

    public function setType(VehicleImageType $type): self
    {
        $this->type = $type;
        return $this;
    }
    public function getAlt(): string
    {
        if (!$this->vehicle) {
            return $this->type->value;
        }

        return sprintf(
            '%s %s - %s',
            $this->vehicle->getBrand()->getName(),
            $this->vehicle->getName(),
            $this->type->value
        );
    }
}
