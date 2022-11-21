<?php

namespace Blomstra\Federation\Types;

use Flarum\Discussion\Discussion;
use Flarum\Post\Post;

class Article extends \ActivityPhp\Type\Extended\Object\Article
{
    public static function fromFirstPost(Post $post): Article
    {

    }

    public static function fromDiscussion(Discussion $discussion): Article
    {
        $article = new Article;

        $article->id = $discussion->id;
        $article->name = $discussion->title;
        $article->content = $discussion->firstPost->content;
        $article->published = $discussion->created_at->toAtomString();

        return $article;
    }
}
