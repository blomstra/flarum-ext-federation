<?php

namespace Blomstra\Federation\Providers;

use ActivityPhp\Server;
use Flarum\Extension\ExtensionManager;
use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Foundation\Config;
use Flarum\Foundation\Paths;
use Illuminate\Contracts\Container\Container;
use Psr\Log\LoggerInterface;

class FederationProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->singleton(Server::class, function (Container $container) {
            /** @var Config $config */
            $config = $container->make(Config::class);
            /** @var Paths $paths */
            $paths = $container->make(Paths::class);
            /** @var ExtensionManager $extensions */
            $extensions = $container->make(ExtensionManager::class);
            $extension = $extensions->getExtension('blomstra-federation');

            return new Server([
                'logger' => [
                    'stream' => $paths->storage . '/logs/federation.log'
                ],
                'http' => [
                    'agent' => 'blomstra/flarum-ext-federation:' . ($extension->getVersion() ?? 'dev')
                ],
                'cache' => [
                    'stream' => $paths->storage . '/cache/federation'
                ],
                'instance' => [
                    'host' => $config->url()->getHost()
                ]
            ]);
        });
    }
}
