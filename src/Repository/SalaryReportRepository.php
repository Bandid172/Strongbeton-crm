<?php

namespace App\Repository;

use App\Entity\SalaryReport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SalaryReport>
 */
class SalaryReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalaryReport::class);
    }

    public function findAllByPayPeriod(string $payPeriod, string $year): array
    {
        $startDate = new \DateTime("$year-01-01 00:00:00");
        $endDate = new \DateTime("$year-12-31 23:59:59");

        return $this->createQueryBuilder('s')
            ->andWhere('s.payPeriod = :payPeriod')
            ->andWhere('s.createdAt BETWEEN :startDate AND :endDate')
            ->setParameter('payPeriod', $payPeriod)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return SalaryReport[] Returns an array of SalaryReport objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SalaryReport
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
