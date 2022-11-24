<?php

namespace Blomstra\Federation\Api\Controllers;

use Blomstra\Federation\Api\Serializers\ArticleSerializer;
use Blomstra\Federation\Types\Article;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\Discussion\DiscussionRepository;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ArticleController extends AbstractShowController
{
    use Concerns\GeneratesPayload;

    public $serializer = ArticleSerializer::class;

    public function __construct(protected DiscussionRepository $discussions)
    {}

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $queryParams = $request->getQueryParams();
        $id = Arr::get($queryParams, 'id');

        $discussion = $this->discussions->findOrFail($id);

        return Article::fromDiscussion($discussion);
    }
}
