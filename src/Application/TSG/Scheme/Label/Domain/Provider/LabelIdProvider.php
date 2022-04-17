<?php

namespace Application\TSG\Scheme\Label\Domain\Provider;


class LabelIdProvider implements LabelIdProviderInterface
{
    private LabelRepositoryInterface $labelRepository;

    public function __construct(LabelRepositoryInterface $labelRepository)
    {
        $this->labelRepository = $labelRepository;
    }

    public function bySlug(string $slug): string
    {
        $label = $this->labelRepository->findOneBy(['slug' => $slug]);

        if (!$label) {
            throw new \InvalidArgumentException(sprintf('Label with slug %s not found', $slug));
        }

        return $label->getId();
    }
}