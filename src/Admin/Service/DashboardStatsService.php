<?php

namespace App\Admin\Service;

use App\Vehicle\Repository\VehicleRepository;
use App\Brand\Repository\BrandRepository;
use App\User\Repository\UserRepository;
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
     */
    public function getStats(): array
    {
        return [
            'vehicles' => $this->vehicleRepository->countVehicles(),
            'brands'   => $this->brandRepository->countBrands(),
            'clients'  => $this->userRepository->countUsers(),
        ];
    }
}
