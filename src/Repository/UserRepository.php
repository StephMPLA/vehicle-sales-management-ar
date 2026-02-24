<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
    /**
     * Counts all registered users with ROLE_USER.
     */
    public function countUsers():int
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where('u.roles NOT LIKE :admin')
            ->setParameter('admin', '%"ROLE_ADMIN"%')
            ->getQuery()
            ->getSingleScalarResult();
    }
    /**
     * @return array<User>
     */
    public function findClients(int $limit = 10): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.roles NOT LIKE :admin')
            ->setParameter('admin', '%"ROLE_ADMIN"%')
            ->orderBy('u.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
