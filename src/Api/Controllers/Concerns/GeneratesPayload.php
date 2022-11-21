<?php

namespace Blomstra\Federation\Api\Controllers\Concerns;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

trait GeneratesPayload
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $document = new Document;
        $data = $this->data($request, $document);

        $serializer = static::$container->make($this->serializer);
        $serializer->setRequest($request);

        $element = $this->createElement($data, $serializer);

        return new JsonResponse(array_merge(
            $element->getAttributes(),
            ['id' => $element->getId()]
        ));
    }
}
