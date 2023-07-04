<?php

namespace Theharisshah\StatamicSeo\Tags;

use Statamic\Support\Arr;
use Statamic\Tags\Tags;
use Statamic\View\View;
use Theharisshah\StatamicSeo\YamlStorageService;

class SeoTag extends Tags
{
    protected static $handle = 'seo';

    public function head()
    {
        $path = storage_path('statamic/addons/seo/settings.yaml');
        $generalSettings = (new YamlStorageService($path))->parse();
        $data['title'] = $this->parseData('meta_title', $this->context, $generalSettings);
        $data['description'] = $this->parseData('meta_description', $this->context, $generalSettings);
        $data['canonical_url'] = $this->parseData('canonical_url', $this->context, $generalSettings);
        $data['site_name'] = $this->parseData('site_name', $this->context, $generalSettings);
        $data['og_image'] = $this->context->value('og_image') ?? $generalSettings['default_og_image'];
        $data['permalink'] = $this->context->value('permalink');

        return (new View())
            ->template('seo::head')
            ->with($data);
    }

    private function parseData($field, $context, $generalSettings): string
    {
        $pattern = '/%(.*?)%/';
        $text = strip_tags($generalSettings["$field"] ?? $context->value($field));
        if (empty($text)) {
            return '';
        }

        return preg_replace_callback($pattern, function ($matches) use ($context, $generalSettings) {
            $word = $matches[1];
            return strip_tags($context->get("$word") ?? $generalSettings["$word"] ?? $word);
        }, $text);
    }
}
