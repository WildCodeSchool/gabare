<?php

namespace App\Repository;

use App\Controller\ArticleController;
use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param int $page
     * @return array
     */

    public function findAllPagesAndSort($page = null)
    {
        $qb = $this->createQueryBuilder('a')
            ->where('CURRENT_DATE() >= a.date')
            ->orderBy('a.date', 'DESC');

        if ($page !== null) {
            $firstResult = ($page - 1) * ArticleController::ARTICLES;
            $qb->setFirstResult($firstResult)->setMaxResults(ArticleController::ARTICLES);
        }

        return $qb->getQuery()->getResult();
    }
}
