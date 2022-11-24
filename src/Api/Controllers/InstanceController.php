<?php

namespace Blomstra\Federation\Api\Controllers;

use Flarum\Api\Controller\AbstractShowController;
use Illuminate\Support\Optional;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class InstanceController extends AbstractShowController
{
    use Concerns\GeneratesPayload;

    protected function data(ServerRequestInterface $request, Document $document)
    {
        return new Optional(new \stdClass);
    }
}
