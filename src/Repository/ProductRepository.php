<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Query
     */
    public function findAllWithSearchManagement(ProductSearch $search): Query
    {
        $query = $this->findAllQuery();
  
        if ($search->getName()) {
            $query = $query->andWhere('REGEXP(p.name, :regexp) = true')
                           ->setParameter('regexp', '.*'.$search->getName().'.*');
        }

        if ($search->getBarCode()) {
            $query = $query->andWhere('REGEXP(p.barCode, :regexp) = true')
                           ->setParameter('regexp', '.*'.$search->getBarCode().'.*');            
        }

        /*if ($search->getCategory()) {
            $query = $query->andWhere('p.category = ')
        }*/

        dump($search);
        return $query->getQuery();    
    }

    public function findAllQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }


}
