<?php

namespace Blomstra\Federation\Api\Controllers;

use Blomstra\Federation\Api\Serializers\WebfingerSerializer;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\Foundation\Config;
use Flarum\User\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class WebfingerController extends AbstractShowController
{
    use Concerns\GeneratesPayload;

    public $serializer = WebfingerSerializer::class;

    public function __construct(protected Config $config, protected UserRepository $users)
    {
    }

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $queryParams = $request->getQueryParams();
        $resource = Arr::get($queryParams, 'resource');

        // fully qualified person name
        $fpcn = Str::after($resource, 'acct:');

        $fpcn = strtolower($fpcn);

        if (empty($fpcn) || Str::endsWith($fpcn, '@' . $this->config->url()->getHost()) === false) {
            return new EmptyResponse(404);
        }

        $username = Str::before($fpcn, '@' . $this->config->url()->getHost());

        return $this->users->findOrFailByUsername($username);
    }
}
