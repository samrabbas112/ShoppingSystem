<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\Orderitem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Orderitem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orderitem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orderitem[]    findAll()
 * @method Orderitem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderitemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orderitem::class);
    }

    // /**
    //  * @return Orderitem[] Returns an array of Orderitem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Orderitem
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllGreaterThanPrice(int $id):?array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT i
            FROM App\Entity\Orderitem i
            WHERE i.orderRef = :price'
        )->setParameter('price', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
}
