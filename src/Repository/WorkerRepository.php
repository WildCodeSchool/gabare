<?php

namespace App\Repository;

use App\Entity\Worker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Worker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Worker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Worker[]    findAll()
 * @method Worker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Worker::class);
    }

    const ACTIVITY = [
        'Salarié',
        'Membre_CA',
        'Ami_CA',
        'Pionnier',
    ];

    public function findAllPioneers()
    {
        $qb = $this->createQueryBuilder('w')
            ->innerJoin('w.activity', 'a')
            ->addSelect('a')
            ->where('a.name = :name')
            ->setParameter('name', self::ACTIVITY[3])
            ->getQuery();

        return $qb->execute();
    }

    public function findAllEmployees()
    {
        $qb = $this->createQueryBuilder('w')
            ->innerJoin('w.activity', 'a')
            ->addSelect('a')
            ->where('a.name = :name')
            ->setParameter('name', self::ACTIVITY[0])
            ->getQuery();

        return $qb->execute();
    }

    public function findAllCAMembers()
    {
        $qb = $this->createQueryBuilder('w')
            ->innerJoin('w.activity', 'a')
            ->addSelect('a')
            ->where('a.name = :name')
            ->setParameter('name', self::ACTIVITY[1])
            ->getQuery();

        return $qb->execute();
    }

    public function findAllCAFriends()
    {
        $qb = $this->createQueryBuilder('w')
            ->innerJoin('w.activity', 'a')
            ->addSelect('a')
            ->where('a.name = :name')
            ->setParameter('name', self::ACTIVITY[2])
            ->getQuery();

        return $qb->execute();
    }

    public function findByActivitiesOrder()
    {
        $qb = $this->createQueryBuilder('w')
            ->innerJoin('w.activity', 'a')
            ->addSelect('a')
            ->orderBy('a.name', 'ASC')
            ->add('orderBy', ['a.name ASC, w.lastName ASC'])
            ->getQuery();

        return $qb->execute();
    }
}
