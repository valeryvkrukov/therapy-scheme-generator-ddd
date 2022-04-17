<?php

namespace Application\TSG\Scheme\Label\Application\Model;

class CreateLabelCommand
{
    private string $shortName;
    private string $reportName;
    private string $slug;

    public function __construct(string $shortName, string $reportName, string $slug)
    {
        $this->shortName = $shortName;
        $this->reportName = $reportName;
        $this->slug = $slug;
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