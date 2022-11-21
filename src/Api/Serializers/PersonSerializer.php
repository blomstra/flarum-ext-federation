<?php

namespace Blomstra\Federation\Api\Serializers;

use Blomstra\Federation\Types\Person;

class PersonSerializer extends AbstractSerializer
{
    public function getId($model)
    {
        return $this->getUrlGenerator()
            ->to('forum')
            ->route('user', ['username' => $model->preferredUsername]);
    }
}
