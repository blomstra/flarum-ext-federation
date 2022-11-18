<?php

namespace Blomstra\Federation\Providers;

use ActivityPhp\Server;
use Flarum\Foundation\AbstractServiceProvider;
use Illuminate\Contracts\Container\Container;
use Psr\Log\LoggerInterface;

class FederationProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->singleton(Server::class, function (Container $container) {
            return new Server([
                'logger' => $container->make(LoggerInterface::class),

            ]);
        });
    }
}
