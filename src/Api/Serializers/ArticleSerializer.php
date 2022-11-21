<?php

namespace Blomstra\Federation\Api\Serializers;

class ArticleSerializer extends AbstractSerializer
{
    public function getId($model)
    {
        return $this->getUrlGenerator()
            ->to('forum')
            ->route('discussion', ['id' => $model->id]);
    }
}
