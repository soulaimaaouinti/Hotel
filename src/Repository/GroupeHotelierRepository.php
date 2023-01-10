<?php

namespace App\Repository;

use App\Entity\GroupeHotelier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupeHotelier>
 *
 * @method GroupeHotelier|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeHotelier|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeHotelier[]    findAll()
 * @method GroupeHotelier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeHotelierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeHotelier::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(GroupeHotelier $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(GroupeHotelier $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return GroupeHotelier[] Returns an array of GroupeHotelier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupeHotelier
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
