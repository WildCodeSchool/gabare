<?php

namespace App\Repository;

use App\Entity\Timetable;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Timetable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Timetable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Timetable[]    findAll()
 * @method Timetable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimetableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Timetable::class);
    }

    const NUMBER_DATES = 12;
    
    public function findByDateExpiration()
    {
        $qb = $this->createQueryBuilder('tt')
            ->where('tt.visitDate >= :dateToday')
            ->setParameter('dateToday', new DateTime('NOW'))
            ->orderBy('tt.visitDate', 'ASC')
            ->setMaxResults(self::NUMBER_DATES);
        $query = $qb->getQuery();
        return $query->execute();
    }
}
