<?php

namespace Application\TSG\Scheme\Label\Application\Service;


use Application\TSG\Scheme\Label\Application\Model\CreateLabelCommand;
use Application\TSG\Scheme\Label\Domain\Entity\Label;
use Application\TSG\Scheme\Label\Domain\Repository\LabelRepositoryInterface;
use Application\TSG\Scheme\Label\Domain\ValueObject\LabelId;
use Ramsey\Uuid\Uuid;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateLabelService implements MessageHandlerInterface
{
    private EventDispatcherInterface $eventDispatcher;
    private LabelRepositoryInterface $labelRepository;
    private SerializerInterface $serializer;

    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        LabelRepositoryInterface $labelRepository,
        SerializerInterface $serializer
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->labelRepository = $labelRepository;
        $this->serializer = $serializer;
    }

    public function __invoke(CreateLabelCommand $createLabelCommand): string
    {
        $label = Label::create(
            new LabelId(Uuid::uuid4()->toString()),
            $createLabelCommand->getShortName(),
            $createLabelCommand->getReportName(),
            $createLabelCommand->getSlug()
        );

        $this->labelRepository->save($label);

        foreach ($label->pullDomainEvents() as $domainEvent) {
            $this->eventDispatcher->dispatch($domainEvent);
        }

        return $this->serializer->serialize($label, 'json');
    }
}