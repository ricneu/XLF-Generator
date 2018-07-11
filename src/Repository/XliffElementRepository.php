<?php

namespace App\Repository;

use App\Entity\XliffElement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method XliffElement|null find($id, $lockMode = null, $lockVersion = null)
 * @method XliffElement|null findOneBy(array $criteria, array $orderBy = null)
 * @method XliffElement[]    findAll()
 * @method XliffElement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class XliffElementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, XliffElement::class);
    }
}
