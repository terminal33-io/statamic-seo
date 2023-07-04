<?php

namespace Theharisshah\StatamicSeo\Listeners;

use Statamic\Events\EntryBlueprintFound;
use Theharisshah\StatamicSeo\Blueprints\PerPageBlueprint;

class AddSeoTabs
{
    public function handle(EntryBlueprintFound $event)
    {
        $blueprint = $event->blueprint;
        $ignoreBlueprints = config('seo-settings.ignore_blueprints');

        if (in_array($blueprint->handle(), $ignoreBlueprints)) {
            return;
        }

        $contents = $event->blueprint->contents();
        $pageSettingsBlueprint = PerPageBlueprint::getBlueprint();
        $pageFields = $pageSettingsBlueprint->contents()['tabs']['main'];
        $contents['tabs']['SEO'] = $pageFields;
        $blueprint->setContents($contents);
    }
}
