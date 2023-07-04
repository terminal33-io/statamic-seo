<?php

namespace Theharisshah\StatamicSeo\Blueprints;

use Statamic\Facades\Blueprint;
use Theharisshah\StatamicSeo\Contracts\BlueprintContract;

class PerPageBlueprint extends BlueprintAbstract
{

    public function getFields(): array
    {
        return [
            'fields' => [
                $this->fieldMetaTitle(),
                $this->fieldMetaDescription(),
                $this->fieldCanonicalUrl(),
                $this->fieldOpenGraph(),
                $this->fieldNoIndex()
            ]
        ];
    }

    private function fieldMetaTitle(): array
    {
        return [
            'handle' => 'meta_title',
            'field' => [
                'type' => 'text',
                'default' => '%title% %title_separator% %site_name%',
                'display' => 'Meta Title',
            ]
        ];
    }

    private function fieldMetaDescription(): array
    {
        return [
            'handle' => 'meta_description',
            'field' => [
                'type' => 'textarea',
                'display' => 'Meta Description',
                'character_limit' => 160,
            ]
        ];
    }

    private function fieldCanonicalUrl(): array
    {
        return [
            'handle' => 'canonical_url',
            'field' => [
                'type' => 'text',
                'display' => 'Canonical URL',
                'instructions' => 'The source or preferred version of this page.',
                'listable' => 'hidden',
            ],
        ];
    }

    private function fieldNoIndex(): array
    {
        return [
            'handle' => 'noindex_page',
            'field' => [
                'type' => 'toggle',
                'display' => 'No Index',
                'instructions' => 'Prevent this page from being indexed by search engines.',
            ],
        ];
    }

    private function fieldOpenGraph(): array
    {
        return [
            'handle' => 'og_image',
            'field' => [
                'type' => 'assets',
                'max_files' => 1,
                'restrict' => false,
                'display' => 'OG Image',
                'instructions' => 'Control how this page looks when shared on websites which interpret Open Graph data (Facebook, LinkedIn etc).',
                'validate' => [
                    'image'
                ],
            ],
        ];
    }
}
