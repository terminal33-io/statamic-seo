<?php

namespace Theharisshah\StatamicSeo\Http\Controllers\CP;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\CP\CpController;
use Theharisshah\StatamicSeo\Blueprints\GeneralSettingsBlueprint;
use Theharisshah\StatamicSeo\YamlStorageService;

class SettingsController extends CPController
{
    protected YamlStorageService $yamlStorageService;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $path = storage_path('statamic/addons/seo/settings.yaml');
        $this->yamlStorageService = (new YamlStorageService($path));
    }

    public function index(GeneralSettingsBlueprint $settingsBlueprint)
    {
        $blueprint = $settingsBlueprint::getBlueprint();
        $title = "Seo Settings";
        $data = $this->yamlStorageService->parse();
        $fields = $blueprint->fields()->addValues($data)->preProcess();

        return view('seo::cp.index', [
            'blueprint' => $blueprint->toPublishArray(),
            'title' => $title,
            'meta' => $fields->meta(),
            'values' => $fields->values()
        ]);
    }

    public function store(Request $request)
    {
        $this->yamlStorageService->store($request->all());
    }
}
