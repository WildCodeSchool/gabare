<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use InvalidArgumentException;

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

    public function findAllPagesAndSort($page, $nbMaxByPage)
    {
        if (!is_numeric($page)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $page est incorrecte (valeur : ' . $page .').'
            );
        }
        if ($page < 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }
        if (!is_numeric($nbMaxByPage)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $nbMaxByPage est incorrecte (valeur : ' . $nbMaxByPage . ').'
            );
        }
        $qb = $this->createQueryBuilder('a')
            ->where('CURRENT_DATE() >= a.datePublication')
            ->orderBy('a.datePublication', 'DESC');

        $query = $qb->getQuery();

        $firstResult = ($page - 1) * $nbMaxByPage;
        $query->setFirstResult($firstResult)->setMaxResults($nbMaxByPage);
        $paginator = new Paginator($query);

        if (($paginator->count() <= $firstResult) && $page !=1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas.');
        }
        return $paginator;
    }
}
