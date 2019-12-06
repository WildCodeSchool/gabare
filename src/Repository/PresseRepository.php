<?php

namespace App\Repository;

use App\Entity\Presse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Presse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Presse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Presse[]    findAll()
 * @method Presse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Presse::class);
    }
}
