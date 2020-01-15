<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Theme;
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
     * @return Article[]
     */
    public function findArticleByTheme(?Theme $theme = null)
    {
        $qb = $this->createQueryBuilder('a')
            ->where('a.theme = :theme')
            ->setParameter('theme', $theme);
        if ($theme == empty([$qb])) {
            return $qb = $this->findBy([], ['date' => 'DESC']);
        }
        $qb->orderBy('a.date', 'DESC');
        return $qb->getQuery()->getResult();
    }
}
