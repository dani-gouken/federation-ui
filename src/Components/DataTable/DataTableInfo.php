<?php
namespace Federation\UI\Components\DataTable;

use Federation\UI\DataFormatter;
use Illuminate\Database\Eloquent\Model;
use Livewire\Wireable;

/**
 * @template T
 */
readonly class DataTableInfo implements Wireable
{
    use DataFormatter;
    public array $actions;
    public array $fields;
    public function __construct(
        public string $name,
        public string $model,
        array $fields = [],
        ?array $actions = null,
        public bool $showTitle = false,
    ) {
        if (is_null($actions)) {
            $route = str($model)->classBasename()->kebab()->lower()->toString();
            $dashboardRoutePrefix = config('federation_ui.dashboard_route_name_prefix', 'dashboard');
            $this->actions = [
                "Nouveau" => [
                    "icon" => 'plus',
                    "url" => route("$dashboardRoutePrefix.$route.create")
                ]
            ];
        } else {
            $this->actions = $actions;
        }

        $this->fields = $this->buildOptions($fields);
    }


    public function toLivewire()
    {
        return [
            "name" => $this->name,
            "model" => $this->model,
            "fields" => $this->fields,
            "actions" => $this->actions,
            "showTitle" => $this->showTitle
        ];
    }

    public static function fromLivewire($value)
    {
        return new self(
            name: $value['name'],
            model: $value['model'],
            fields: $value['fields'],
            actions: $value['actions'],
            showTitle: $value['showTitle']
        );
    }

    /**
     * @return array<string,string>
     */
    public function titles(): array
    {
        $titles = [];
        foreach ($this->fields as $field => $options) {
            $titles[$field] = $this->format($field, format: 'title', options: $options);
        }
        return $titles;
    }

    public function formatted(?Model $model = null)
    {
        $formatted = [];
        foreach ($this->fields as $field => $options) {
            $formatted[$field] = $this->format($field, options: $options, model: $model);
        }
        return $formatted;
    }
}