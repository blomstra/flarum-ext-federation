<?php

namespace Blomstra\Federation\Publish;

use ActivityPhp\Server;
use Blomstra\Federation\Types\Article;
use Flarum\Approval\Event\PostWasApproved;
use Flarum\Post\Event\Posted;
use Illuminate\Contracts\Events\Dispatcher;

class DiscussionsToArticles
{
    public function __construct(protected Server $federation)
    {}

    public function subscribe(Dispatcher $events): void
    {
        $events->listen([
            Posted::class, PostWasApproved::class
        ], [$this, 'publish']);
    }

    public function publish(Posted|PostWasApproved $event): void
    {
        if ($event instanceof Posted && ($event->post->number > 1 || $event->post->is_approved === false)) {
            return;
        }

        $article = Article::fromFirstPost($event->post);

        $this->federation->actor();
    }
}
