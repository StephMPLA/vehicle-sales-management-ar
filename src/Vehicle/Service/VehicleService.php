<?php

namespace App\Vehicle\Service;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Handles vehicle persistence operations.
 */
class VehicleService
{
    public function __construct(
        private EntityManagerInterface $em
    )
    {
    }

    public function create(Vehicle $vehicle): void
    {
        $this->em->persist($vehicle);
        $this->em->flush();
    }

    public function update(): void
    {
        $this->em->flush();
    }

    public function delete(Vehicle $vehicle): void
    {
        $this->em->remove($vehicle);
        $this->em->flush();
    }
}
