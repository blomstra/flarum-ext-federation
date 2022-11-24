<?php

namespace Blomstra\Federation\Api\Serializers;

use Carbon\Carbon;
use Flarum\Foundation\Application;
use Flarum\Foundation\Config;
use Flarum\Locale\LocaleManager;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;

class InstanceSerializer extends AbstractSerializer
{
    public function __construct(
        protected Config $config,
        protected SettingsRepositoryInterface $settings,
        protected LocaleManager $locales
    ) {}

    public function getId($model)
    {
        return $this->getUrlGenerator()
            ->to('forum')
            ->base();
    }

    protected function getDefaultAttributes($model)
    {
        return [
            'domain' => $this->config->url()->getHost(),
            'title' => $this->settings->get('forum_title'),
            'version' => Application::VERSION,
            'source_url' => 'https://github.com/flarum/flarum',
            'description' => $this->settings->get('forum_description'),
            'usage' => [
                'users' => [
                    'active_month' => User::query()
                        ->withoutGlobalScopes()
                        ->where('last_seen_at', '>=', Carbon::now()->startOfMonth())
                        ->count()
                ]
            ],
            // @todo thumbnail
            'languages' => $this->getLocales(),
            'configuration' => [
                'urls' => [
//                    'streaming' => 'wss://' . $this->config->url()->getHost()
                ]
            ],
            'registrations' => [
                'enabled' => (bool) $this->settings->get('allowSignUp'),
                'approval_required' => false,
                'message' => null,
            ],
            'contact' => [
                'email' => $this->settings->get('mail_from')
            ]
        ];
    }

    protected function getLocales(): array
    {
        $locales = $this->locales->getLocales();

        if (boolval($this->settings->get('show_language_selector')) === true) {
            return array_keys($locales);
        }

        return [array_flip($locales)['Default'] ?? $this->settings->get('default_locale', 'en')];
    }
}
