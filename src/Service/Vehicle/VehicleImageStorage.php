<?php
namespace App\Service\Vehicle;

use App\Entity\Vehicle;
use App\Entity\VehicleImage;
use Doctrine\ORM\EntityManagerInterface;
use Random\RandomException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class VehicleImageStorage
{
    public function __construct(
        private EntityManagerInterface $em,

        #[Autowire('%vehicle_upload_dir%')]
        private string $uploadDir
    ) {}

    /**
     * @throws RandomException
     */
    public function upload(
        Vehicle $vehicle,
        UploadedFile $file
    ): void {

        $name = bin2hex(random_bytes(16))
            .'.'.$file->guessExtension();

        $file->move($this->uploadDir, $name);

        $img = new VehicleImage();
        $img->setPath($name);
        $img->setVehicle($vehicle);

        $this->em->persist($img);
    }

    public function deleteAll(Vehicle $vehicle): void
    {
        foreach ($vehicle->getImages() as $image) {

            $file = $this->uploadDir.'/'.$image->getPath();

            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
