<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicle>
 *
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicle[]    findAll()
 * @method Vehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    public function save(Vehicle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vehicle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param int $limit
     * @return float|int|mixed|string
     */
    public function getLatestOffers(int $limit = 16): mixed
    {
        return $this->createQueryBuilder('v')
            ->select('v')
            ->orderBy('v.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param string|null $param
     * @param null $type
     * @param null $price
     * @param null $year
     * @param null $milliage
     * @param int $limit
     * @return float|int|mixed|string
     */
    public function getOffersIncludingSearchParameters(string $param = null, $type = null, $price = null, $year = null, $milliage = null, int
    $limit = 16): mixed
    {
        $query = $this->createQueryBuilder('v');
        if($param !== '') {
            $query
                ->andWhere('MATCH_AGAINST(v.brand, v.model) AGAINST(:param boolean)>0')
                ->setParameter('param', $param)
            ;
        }

        if (isset($type)){
            $query->leftJoin('v.vehicleType', 'vt')
                ->andWhere('vt.id = :type')
                ->setParameter('type', $type);
        }

        if (isset($price)){
            $query->andWhere(
                $query->expr()->between('v.price', 0, ':price')
            )->setParameter('price', $price);
        }

        if (isset($milliage)){
            $query->andWhere(
                $query->expr()->between('v.milliage', 0, ':milliage')
            )->setParameter('milliage', $milliage);
        }

        if ($year){
            $query->andWhere(
                $query->expr()->between('v.year', ':year', date('Y'))
            )->setParameter('year', $year);
        }

        $query
            ->orderBy('v.id', 'DESC')
            ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Vehicle[] Returns an array of Vehicle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vehicle
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
