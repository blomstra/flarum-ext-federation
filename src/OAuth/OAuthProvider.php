<?php

namespace Blomstra\Federation\OAuth;

use Flarum\Settings\SettingsRepositoryInterface;
use FoF\OAuth\Provider;
use Psr\Http\Message\ServerRequestInterface;

class OAuthProvider extends Provider
{
    protected ?ServerRequestInterface $request = null;

    public function __construct(SettingsRepositoryInterface $settings, ServerRequestInterface $request = null)
    {
        parent::__construct($settings);

        $this->request = $request;
    }

    public function name(): string
    {
        return 'federation';
    }

    public function link(): string
    {
        // TODO: Implement link() method.
    }

    public function fields(): array
    {
        // TODO: Implement fields() method.
    }
}
