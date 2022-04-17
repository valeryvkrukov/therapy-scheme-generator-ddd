<?php

namespace Application\TSG\Scheme\Label\Domain\Repository;


use Application\TSG\Scheme\Label\Domain\Entity\Label;

interface LabelRepositoryInterface
{
    public function findOneBy(array $criteria, array $orderBy = null);

    public function save(Label $label): void;
}