<?php
namespace App\Service\Vehicle;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Random\RandomException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class VehicleModelStorage
{
    public function __construct(
        private EntityManagerInterface $em,

        #[Autowire('%vehicle_model_dir%')]
        private string $modelDir
    ) {}

    /**
     * @throws RandomException
     */
    public function upload(
        Vehicle $vehicle,
        UploadedFile $file
    ): string {

        // delete old first
        $this->delete($vehicle);

        $filename = bin2hex(random_bytes(16)).'.glb';

        $file->move($this->modelDir, $filename);

        $vehicle->setModel3dPath(
            '/uploads/models/'.$filename
        );

        $this->em->flush();

        return $vehicle->getModel3dPath();
    }

    public function delete(Vehicle $vehicle): void
    {
        if (!$vehicle->getModel3dPath()) {
            return;
        }

        $file = $this->modelDir.'/'
            .basename($vehicle->getModel3dPath());

        if (is_file($file)) {
            unlink($file);
        }

        $vehicle->setModel3dPath(null);
    }
}
