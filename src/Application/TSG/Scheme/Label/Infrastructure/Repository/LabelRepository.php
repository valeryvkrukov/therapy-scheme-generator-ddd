<?php

namespace Application\TSG\Scheme\Label\Infrastructure\Repository;


use Application\TSG\Scheme\Label\Domain\Entity\Label;
use Application\TSG\Scheme\Label\Domain\Repository\LabelRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LabelRepository extends ServiceEntityRepository implements LabelRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Label::class);
    }

    public function save(Label $label): void
    {
        $this->_em->persist($label);
        $this->_em->flush();
    }
}