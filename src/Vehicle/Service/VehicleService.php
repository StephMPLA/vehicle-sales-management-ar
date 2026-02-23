<?php

namespace App\Vehicle\Service;

use App\Entity\Vehicle;
use App\Entity\VehicleImage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class VehicleService
{
    public function __construct(
        private EntityManagerInterface $em,

        #[Autowire('%vehicle_upload_dir%')]
        private string $uploadDir,

        #[Autowire('%vehicle_model_dir%')]
        private string $modelDir
    ) {}

    public function create(Vehicle $vehicle): void
    {
        $this->em->persist($vehicle);
        $this->em->flush();
    }

    public function delete(Vehicle $vehicle): void
    {
        $this->em->remove($vehicle);
        $this->em->flush();
    }

    public function update(
        Vehicle $vehicle,
        array $files = [],
        ?UploadedFile $modelFile = null
    ): void {

        // ---------- 3D MODEL ----------
        if ($modelFile) {

            $name = bin2hex(random_bytes(16)).'.glb';

            $modelFile->move($this->modelDir, $name);

            $vehicle->setModel3dPath('/uploads/models/'.$name);


            $this->em->persist($vehicle);
        }

        // ---------- IMAGES ----------
        foreach ($files as $file) {

            $name = bin2hex(random_bytes(16)).'.'.$file->guessExtension();

            $file->move($this->uploadDir, $name);

            $img = new VehicleImage();
            $img->setPath($name);
            $img->setAlt($vehicle->getName());
            $img->setVehicle($vehicle);

            $this->em->persist($img);
        }

        $this->em->flush();
    }
}
