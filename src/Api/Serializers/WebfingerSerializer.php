<?php

namespace Blomstra\Federation\Api\Serializers;

use Flarum\Foundation\Config;
use Flarum\Http\UrlGenerator;
use Flarum\User\User;

class WebfingerSerializer extends AbstractSerializer
{
    public function __construct(protected Config $config, protected UrlGenerator $url)
    {
    }

    public function getId($model)
    {
        return $this->getUrlGenerator()
            ->to('forum')
            ->route('user', ['username' => $model->slug]);
    }

    /**
     * @param User $model
     * @return string[]
     */
    protected function getDefaultAttributes($model)
    {
        $host = $this->config->url()->getHost();

        return [
            'subject' => "acct:$model->username@$host",
            'aliases' => [
                $this->url->to('forum')->route('user', ['username' => $model->slug])
            ]
        ];
    }
}
