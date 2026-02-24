<?php

namespace App\Service\Vehicle;

use App\Entity\Vehicle;
use App\Entity\VehicleImage;
use Doctrine\ORM\EntityManagerInterface;
use Random\RandomException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class VehicleService
{

    public function __construct(
        private EntityManagerInterface $em,
        private VehicleModelStorage $modelStorage,
        private VehicleImageStorage $imageStorage
    ) {}

    public function create(Vehicle $vehicle): void
    {
        $this->em->persist($vehicle);
        $this->em->flush();
    }
    public function deleteModel(Vehicle $vehicle): void
    {
        $this->modelStorage->delete($vehicle);
        $this->em->flush();
    }
    public function delete(Vehicle $vehicle): void
    {
        $this->modelStorage->delete($vehicle);
        $this->imageStorage->deleteAll($vehicle);

        $this->em->remove($vehicle);
        $this->em->flush();
    }
    public function save(Vehicle $vehicle): void
    {
        $this->em->flush();
    }
    /**
     * @throws RandomException
     */
    public function uploadModel(
        Vehicle $vehicle,
        UploadedFile $file
    ): string {

        return $this->modelStorage->upload($vehicle, $file);
    }
}
