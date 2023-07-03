<?php

namespace Theharisshah\StatamicSeo\Listeners;

use Statamic\Events\EntryBlueprintFound;

class AddSeoTabs
{
    public function handle(EntryBlueprintFound $event)
    {
        $blueprint = $event->blueprint;
        $ignoreBlueprints = config('seo-settings.ignore_blueprints');
        
        if (in_array($blueprint->handle(), $ignoreBlueprints)) {
            return;
        }

        $blueprint->ensureFieldsInTab($this->addMetaFields(), 'SEO');
    }


    private function addMetaFields()
    {
        return [
            'meta_title' => [
                'type' => 'text',
            ],
            'meta_description' => [
                'type' => 'textarea'
            ]
        ];
    }
}
