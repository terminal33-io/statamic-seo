<?php

namespace Theharisshah\StatamicSeo;

use Statamic\Events\EntryBlueprintFound;
use Statamic\Facades\CP\Nav;
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

    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php'
    ];

    public function bootAddon()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'seo');
        $this->mergeConfigFrom(__DIR__ . '/../config/seo-settings.php', 'seo-settings');
        $this->publishes([
            __DIR__ . '/../config/seo-settings.php' => config_path('seo-settings.php'),
        ], 'config');

        $this->bootNav();

    }

    public function bootNav()
    {
        Nav::extend(function ($nav) {
            $nav->content('SEO Settings')
                ->section('Tools')
                ->icon('seo-search-graph')
                ->route('seo.settings');
        });
    }
}
