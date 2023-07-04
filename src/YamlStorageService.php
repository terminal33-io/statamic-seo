<?php

namespace Theharisshah\StatamicSeo;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;
use Statamic\Assets\Asset;
use Statamic\Facades\Asset as AssetFacade;

class YamlStorageService
{
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function store(array $data)
    {
        $yaml = Yaml::dump($data, 2, 4);
        $directory = dirname($this->filePath);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        file_put_contents($this->filePath, $yaml);
    }

    public function parse()
    {

        if (file_exists($this->filePath)) {
            $data = Yaml::parseFile($this->filePath);

            return $this->processAssets($data);
        }
        return [];
    }

    protected function processAssets($data)
    {
        array_walk_recursive($data, function (&$value) {

            if (is_string($value) && str_starts_with($value, 'assets::')) {
                $assetPath = str_replace('assets::', '', $value);
                $asset = AssetFacade::query()
                    ->where('container', config('seo-settings.asset_container'))
                    ->where('path', $assetPath)
                    ->first();
                $value = $asset instanceof Asset ? $asset : $value;
            }
        });

        return $data;
    }

}
