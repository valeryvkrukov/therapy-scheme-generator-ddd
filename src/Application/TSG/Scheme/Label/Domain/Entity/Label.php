<?php

namespace Application\TSG\Scheme\Label\Domain\Entity;


use Shared\Aggregate\AggregateRoot;
use Application\TSG\Scheme\Label\Domain\Event\LabelCreatedEvent;
use Application\TSG\Scheme\Label\Domain\ValueObject\LabelId;

class Label extends AggregateRoot
{
    private string $id;
    private string $shortName;
    private string $reportName;
    private string $slug;

    public function __construct(LabelId $id, string $shortName, string $reportName = null, string $slug) {
        $this->id = $id->getValue();
        $this->shortName = $shortName;
        $this->reportName = $reportName ?? $shortName;
        $this->slug = $slug;
    }

    public static function create(LabelId $id, string $shortName, string $reportName = null, string $slug): self
    {
        $label = new self($id, $shortName, $reportName, $slug);
        $label->recordDomainEvent(new LabelCreatedEvent($id));

        return $label;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function getReportName(): string
    {
        return $this->reportName;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}