<?php

namespace Theharisshah\StatamicSeo\Blueprints;

use Statamic\Facades\Blueprint;

abstract class BlueprintAbstract
{
    abstract function getFields(): array;

    static function getBlueprint()
    {
        $instance = new static();

        return Blueprint::make()->setContents([
            'sections' => [
                'main' => $instance->getFields()
            ]
        ]);
    }
}
