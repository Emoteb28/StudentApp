<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }


    /**
     * @return array
     */
    public function findByGender(): array
    {
        return $this->findVisibleQueries('Mlle')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }
    /**
     * @return array
     */
    public function findStudentList(): array
    {
        return $this->builder()
            ->getQuery()
            ->getResult();
    }


    private function builder(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    /**
     * @param $value
     * @return QueryBuilder
     * Select by something
     */
    private function findVisibleQueries($value): QueryBuilder
    {

        return $this->createQueryBuilder('s')
            ->andWhere('s.gender = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC');
    }
    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
