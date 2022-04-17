<?php

namespace Application\TSG\Scheme\Label\Domain\Event;


use Shared\Event\DomainEventInterface;
use Application\TSG\Scheme\Label\Domain\ValueObject\LabelId;
use Symfony\Contracts\EventDispatcher\Event;

class LabelCreatedEvent extends Event implements DomainEventInterface
{
    private LabelId $labelId;
    protected \DateTimeImmutable $occurredAt;

    public function __construct(LabelId $labelId)
    {
        $this->labelId = $labelId;
        $this->occurredAt = new \DateTimeImmutable();
    }

    public function getLabelId(): LabelId
    {
        return $this->labelId;
    }

    public function getOccuredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }
}