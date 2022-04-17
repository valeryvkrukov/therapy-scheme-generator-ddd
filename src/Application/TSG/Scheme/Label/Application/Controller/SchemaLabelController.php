<?php

namespace Application\TSG\Scheme\Label\Application\Controller;


use Application\TSG\Scheme\Label\Application\Model\CreateLabelCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/labels', name: 'api_scheme_label')]
class SchemaLabelController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $parameters = json_decode(
            //$request->getContent(),
            json_encode(['shortName' => 'TEST OK2', 'reportName' => 'REPORT VALUE', 'slug' => 'test-ok-2']),
            true, 
            512
        );

        $createLabelCommand = new CreateLabelCommand(
            $parameters['shortName'],
            $parameters['reportName'] ?? $parameters['shortName'],
            $parameters['slug']
        );

        return JsonResponse::fromJsonString($this->handle($createLabelCommand));
    }
}