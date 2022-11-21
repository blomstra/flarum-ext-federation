<?php

namespace Blomstra\Federation\Api\Serializers;

use ActivityPhp\Type\Core\ObjectType;
use Flarum\Http\UrlGenerator;

abstract class AbstractSerializer extends \Flarum\Api\Serializer\AbstractSerializer
{
    public function getUrlGenerator(): UrlGenerator
    {
        return static::$container->make(UrlGenerator::class);
    }

    public function getType($model)
    {
        return $model->type;
    }

    /**
     * @param ObjectType $model
     * @return array
     */
    protected function getDefaultAttributes($model)
    {
        return $model->toArray();
    }
}
