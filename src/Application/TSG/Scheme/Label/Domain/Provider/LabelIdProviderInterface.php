<?php

namespace Application\TSG\Scheme\Label\Domain\Provider;


interface LabelIdProviderInterface
{
    public function bySlug(string $slug): string;
}