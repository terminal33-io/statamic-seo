<?php

namespace Theharisshah\StatamicSeo;

use Statamic\Events\EntryBlueprintFound;
use Statamic\Providers\AddonServiceProvider;
use Theharisshah\StatamicSeo\Listeners\AddSeoTabs;
use Theharisshah\StatamicSeo\Tags\SeoTag;

class ServiceProvider extends AddonServiceProvider
{
    protected $listen = [
        EntryBlueprintFound::class => [
            AddSeoTabs::class
        ]
    ];

    protected $tags = [
        SeoTag::class,
    ];

    public function bootAddon()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'seo');
        $this->mergeConfigFrom(__DIR__ . '/../config/seo-settings.php', 'seo-settings');
        $this->publishes([
            __DIR__ . '/../config/seo-settings.php' => config_path('seo-settings.php'),
        ], 'config');

    }
}
