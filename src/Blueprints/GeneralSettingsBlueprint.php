<?php

namespace Theharisshah\StatamicSeo\Blueprints;
class GeneralSettingsBlueprint extends BlueprintAbstract
{
    public function getFields(): array
    {
        return [
            'fields' => [
                $this->fieldTitleSeparator(),
                $this->fieldSiteName(),
                $this->fieldOpenGraph(),
                $this->fieldNoIndex()
            ]
        ];
    }

    private function fieldTitleSeparator(): array
    {
        return [
            'handle' => 'title_separator',
            'field' => [
                'type' => 'select',
                'display' => 'Title separator',
                'instructions' => 'Set the character to separate the site and page names in the meta title.',
                'instructions_position' => 'below',
                'default' => '|',
                'options' => [
                    '|',
                    '-',
                    '~',
                    '•',
                    '/',
                    '//',
                    '»',
                    '«',
                    '>',
                    '<',
                    '*',
                    '+',
                ],
                'width' => 33,
            ],
        ];
    }

    private function fieldSiteName(): array
    {
        return [
            'handle' => 'site_name',
            'field' => [
                'type' => 'text',
                'display' => 'Website name',
                'instructions' => 'Set the name for the website. This will be used in generated meta titles',
                'instructions_position' => 'below',
                'width' => 66
            ]
        ];
    }

    private function fieldOpenGraph(): array
    {
        return [
            'handle' => 'default_og_image',
            'field' => [
                'type' => 'assets',
                'max_files' => 1,
                'restrict' => false,
                'display' => 'OG Image',
                'container' => config('seo-settings.asset_container'),
                'instructions' => 'Select the default Open Graph image in case a page or post do not have that set up. ' .
                    'Recommended size `1.91:1` (e.g. `1200x627`).',
                'validate' => [
                    'image'
                ],
            ],
        ];
    }

    private function fieldNoIndex(): array
    {
        return [
            'handle' => 'noindex_site',
            'field' => [
                'type' => 'toggle',
                'display' => 'No Index',
                'instructions' => 'Prevent indexing across the entire site',
            ],
        ];
    }
}
