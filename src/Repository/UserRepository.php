<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

        /**
     * @return Query
     */
    public function findAllWithSearchManagement(UserSearch $search): Query
    {
        $query = $this->findAllQuery();
  
        if ($search->getFirstName()) {
            $query = $query->andWhere('REGEXP(u.firstname, :regexp) = true')
                           ->setParameter('regexp', '.*'.$search->getFirstname().'.*');
        }

        if ($search->getLastName()) {
            $query = $query->andWhere('REGEXP(u.lastname, :regexp) = true')
                           ->setParameter('regexp', '.*'.$search->getLastname().'.*');            
        }

        if ($search->getStatus() && $search->getStatus()->getTitle() != 'Tous') {
            $query = $query->andWhere('u.status = :status')
                           ->setParameter('status', $search->getStatus());
        }

        return $query->getQuery();    
    }

    public function findAllQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('u');
    }
}
