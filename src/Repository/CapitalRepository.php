<?php

namespace App\Repository;

use App\Entity\Capital;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Capital|null find($id, $lockMode = null, $lockVersion = null)
 * @method Capital|null findOneBy(array $criteria, array $orderBy = null)
 * @method Capital[]    findAll()
 * @method Capital[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapitalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Capital::class);
    }
}
