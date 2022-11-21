<?php

namespace Blomstra\Federation;

use Blomstra\Federation\OAuth\OAuthProvider;
use Flarum\Extend as Flarum;
use FoF\Oauth\Extend as Oauth;

return [
//    new Oauth\RegisterProvider(OAuthProvider::class),
    (new Flarum\ServiceProvider())->register(Providers\FederationProvider::class),
    (new Flarum\Routes('api'))
        ->get(
            '/federation/u/{username}',
            'blomstra.federation.person',
            Api\Controllers\PersonController::class
        )
    ->get(
        '/federation/d/{id}',
        'blomstra.federation.article',
        Api\Controllers\ArticleController::class
    )
];
