<?php

namespace App\Repository;
use App\Entity\Orderitem;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    // /**
    //  * @return Order[] Returns an array of Order objects
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
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function gethhjh(int $id): ?array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->INNERJoin('App\Entity\Orderitem', 'i')
            ->andWhere('i.orderRef= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->execute();
//        $entityManager = $this->getEntityManager();

//        $query = $entityManager->createQuery(
//            'SELECT o.items
//            FROM App\Entity\Order o
//            INNER JOIN App\Entity\Orderitem i
//            ON i.order_ref_id=o.id
//            INNER JOIN APP\Entity\Product p
//            ON i.product_id=p.id
//            WHERE o.id = :id'
//        )->setParameter('id', $id);
//
//        return $query->getOneOrNullResult();
    }

}
