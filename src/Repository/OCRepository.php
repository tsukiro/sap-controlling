<?php

namespace App\Repository;

use App\Entity\OC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class OCRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OC::class);
    }
    public function getOCBusqueda($busqueda){
      return $this->createQueryBuilder('c')
          ->where("c.observacion LIKE :busqueda OR c.numero LIKE :numero")
          ->setParameter('busqueda', "%".$busqueda."%")
          ->setParameter('numero', "%".$busqueda."%")
          ->getQuery()
          ->getResult()
        ;
    }
    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('o')
            ->where('o.something = :value')->setParameter('value', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
