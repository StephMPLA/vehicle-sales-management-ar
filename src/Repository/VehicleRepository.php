<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicle>
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    //    /**
    //     * @return Vehicle[] Returns an array of Vehicle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Vehicle
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * Returns the total number of vehicles stored in database.
     */
    public function getDashboardStats(): array
    {
        return $this->createQueryBuilder('v')
            ->select('COUNT(v.id) as vehicles')
            ->addSelect('COUNT(DISTINCT b.id) as brands')
            ->join('v.brand', 'b')
            ->getQuery()
            ->getSingleResult();
    }

    public function getVehicles(): array
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->getQuery()
            ->getResult();
    }

    public function findAvailable(): array
    {
        return $this->createQueryBuilder('v')
            ->leftJoin('v.images', 'i')->addSelect('i')
            ->leftJoin('v.brand', 'b')->addSelect('b')
            ->leftJoin('v.category', 'c')->addSelect('c')
            ->leftJoin('v.fuel', 'f')->addSelect('f')
            ->leftJoin('v.transmission', 't')->addSelect('t')
            ->leftJoin('v.status', 's')
            ->where('s.name = :status')
            ->setParameter('status', 'Available')
            ->orderBy('v.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function getVehiclesUsed(): array
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->where('v.used = :used')
            ->setParameter('used', true)
            ->getQuery()
            ->getResult();
    }
}
