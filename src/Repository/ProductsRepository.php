<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Products>
 *
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

    public function findProductsPaginated(int $page, string $slug, int $limit = 6): array
    {
        $limit = abs($limit);

        $result = [];

        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('s', 'p')
            ->from('App\Entity\Products', 'p')
            ->join('p.sousCategories', 's')
            ->where("s.slug = '$slug'")
            ->setMaxResults($limit)
            ->setFirstResult(($page * $limit - $limit));

        $pagninator = new Paginator($query);
        $data = $pagninator->getQuery()->getResult();

        //On vérifie qu'on a des données

        if(empty($data)){
            return $result;
        }

        //On calcule le nombre de pages

        $pages = ceil($pagninator->count() / $limit);

        //On remplit le tableau

        $result['data'] = $data;
        $result['pages'] = $pages;
        $result['page'] = $page;
        $result['limit'] = $limit;



        return $result;
    }

    public function add(Products $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Products $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Products[] Returns an array of Products objects
    */
   public function findByRand(): array
   {
       return $this->createQueryBuilder('p')
           ->orderBy('RAND()')
           ->setMaxResults(3)
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Products
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
