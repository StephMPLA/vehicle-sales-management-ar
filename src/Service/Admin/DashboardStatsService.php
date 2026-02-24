<?php

namespace App\Service\Admin;

use App\Entity\User;
use App\Entity\Vehicle;
use App\Repository\BrandRepository;
use App\Repository\UserRepository;
use App\Repository\VehicleRepository;

/**
 * Application service responsible for computing
 * global statistics displayed in the admin dashboard.
 *
 * This service centralizes repository calls and keeps
 * controllers lightweight.
 */
class DashboardStatsService
{
    public function __construct(
        private VehicleRepository $vehicleRepository,
        private BrandRepository $brandRepository,
        private UserRepository $userRepository,
    ) {}
    /**
     * Returns aggregated statistics for the admin dashboard.
     *
     * @return array{
     *     vehicleCount:int,
     *     brandCount:int,
     *     clientCount:int,
     *     clientsList: User[],
     *     vehiclesView: Vehicle[]
     * }
     */
    public function getStats(): array
    {
        return [
            'vehicleCount' => $this->vehicleRepository->count([]),
            'brandCount'   => $this->brandRepository->count([]),
            'clientCount'  => $this->userRepository->countUsers(),
            'clientsList'  => $this->userRepository->findClients(),
            'vehiclesView' => $this->vehicleRepository->findBy([], ['id'=>'DESC'], 10),
        ];
    }
}
