<?php

namespace App\Repository;

use App\Entity\Pago;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PagoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pago::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function getAllPagos($currentPage = 1)
    {
        // Create our query
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->getQuery();

        // No need to manually get get the result ($query->getResult())

        $paginator = $this->paginate($query, $currentPage,10);

        return $paginator;
    }
    public function getPagoBusqueda($busqueda){
      return $this->createQueryBuilder('p')
          ->where("p.factura = :factura OR p.descripcion LIKE :busqueda")
          ->setParameter('factura', $busqueda)
          ->setParameter('busqueda', $busqueda)
          ->getQuery()
          ->getResult()
        ;
    }
    public function paginate($dql, $page = 1, $limit = 5)
    {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1)) // Offset
            ->setMaxResults($limit); // Limit

        return $paginator;
    }
}
