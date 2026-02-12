<?php

namespace App\Vehicle\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class VehicleCreateDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 180)]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $year;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $horsePower;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $weight;

    #[Assert\NotBlank]
    public string $description;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $price;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    public int $mileage;

    public bool $isNew = false;

    public ?string $model3dPath = null;

    #️⃣ relations → IDs seulement
    #[Assert\NotBlank]
    public int $brandId;

    #[Assert\NotBlank]
    public int $categoryId;

    #[Assert\NotBlank]
    public int $fuelId;

    #[Assert\NotBlank]
    public int $transmissionId;

    #[Assert\NotBlank]
    public int $statusId;
}
