<?php

namespace Blomstra\Federation\Types;

use Flarum\Post\Post;

class Article extends \ActivityPhp\Type\Extended\Object\Article
{
    public static function fromFirstPost(Post $post): Article
    {

    }
}
