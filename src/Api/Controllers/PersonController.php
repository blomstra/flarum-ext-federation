<?php

namespace Blomstra\Federation\Api\Controllers;

use Blomstra\Federation\Api\Serializers\PersonSerializer;
use Blomstra\Federation\Types\Person;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\User\UserRepository;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class PersonController extends AbstractShowController
{
    use Concerns\GeneratesPayload;

    public $serializer = PersonSerializer::class;

    public function __construct(protected UserRepository $users)
    {}

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $queryParams = $request->getQueryParams();
        $username = Arr::get($queryParams, 'username');

        $user = $this->users->findOrFailByUsername($username);

        return Person::fromUser($user);
    }
}
