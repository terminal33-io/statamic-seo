<?php

namespace Theharisshah\StatamicSeo\Tags;

use Statamic\Tags\Tags;
use Statamic\View\View;

class SeoTag extends Tags
{
    protected static $handle = 'seo';

    public function head()
    {
        $metaDescription = $this->context->get('meta_description');
        $metaTitle = $this->context->get('meta_title');
        return (new View())
            ->template('seo::head')
            ->with(['title' => $metaTitle, 'description' => $metaDescription]);
    }
}
