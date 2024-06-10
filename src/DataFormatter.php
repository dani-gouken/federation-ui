<?php
namespace Federation\UI;

use Illuminate\Database\Eloquent\Model;

trait DataFormatter
{

    public function format(string $field, ?Model $model = null, array|string $options = [], string $format = ""): string
    {
        if (empty($format) && isset($options['format'])) {
            $format = $options['format'];
            unset($options['format']);
        }
        if (empty($format)) {
            throw new \UnexpectedValueException("the format should not be empty. you should either pass the format as a parameter or provide a format in the options");
        }
        return $this->applyFormat($field, $format, $model, $options);
    }

    protected function applyFormat(string $field, string $format, ?Model $model = null, array $options = []): string
    {
        $formatFunc = "format" . str($format)->camel()->toString();
        return $this->{$formatFunc}($field, $model, $options);
    }

    protected function formatNone(string $field, ?Model $model = null, array $options = [])
    {
        return $this->extractValue($field, $model, $options['default_value'] ?? '');
    }
    protected function formatMap(string $field, ?Model $model = null, array $options = [])
    {
        $value = $this->extractValue($field, $model, $options['default_value'] ?? '');
        $map = $options['map'] ?? [];
        if (array_key_exists($value, $map)) {
            return $map[$value];
        }
        return $value;
    }

    protected function formatCallback(string $field, ?Model $model = null, array $options = [])
    {
        $value = $this->extractValue($field, $model, $options['default_value'] ?? '');
        return $options['callback']($value);
    }

    protected function formatBoolean(string $field, ?Model $model = null, array $options = [])
    {
        $value = $this->extractValue($field, $model, $options['default_value'] ?? '');
        return (is_bool($value) && $value == true) || (!empty($value)) ? '<span class="badge bg-primary text-primary-fg">Oui</span>' : '<span class="badge  text-danger-fg bg-danger">Non</span>';
    }

    protected function formatRelation(string $field, ?Model $model = null, array $options = [])
    {
        $fieldParts = str($field)->explode('.');
        $relationModelAccesor = $fieldParts->slice(0, -1)->join('.');
        $relationModelField = $fieldParts->pop();
        $relationModel = $this->extractValue($relationModelAccesor, $model, $options['default_value'] ?? null);

        $value = htmlentities($this->extractValue($relationModelField, $relationModel));
        if (is_null($relationModel)) {
            return "-";
        }
        $params = $options['route_params'] ?? [];
        $params[] = $relationModel;
        $route = dashboard_route('show', ...$params);
        return "<a href='$route'>$value</a>";
    }
    protected function formatSelf(string $field, ?Model $model = null, array $options = [])
    {
        $value = htmlentities($this->extractValue($field, $model));
        $params = $options['route_params'] ?? [];
        $params[] = $model;
        $route = dashboard_route('show', ...$params);
        return "<a href='$route'>$value</a>";
    }

    protected function formatTitle(string $field, ?Model $model = null, array $options = [])
    {
        return $options['title'] ?? $field;
    }

    protected function formatEnum(string $field, ?Model $model = null, array $options = [])
    {
        $value = $this->extractValue($field, $model);
        $formatted = method_exists($value, 'format') ? $value->format() : $value->value;
        if (!method_exists($value, 'format')) {
            return $formatted;
        }
        $color = $value->color();
        return "<span class='badge bg-$color-lt'>$formatted</span>";
    }

    protected function formatMoney(string $field, ?Model $model = null, array $options = [])
    {
        return number_format($this->extractValue($field, $model), 2, ',', ' ') . ' ' . config('mars.currency.code');
    }

    protected function formatDate(string $field, ?Model $model = null, array $options = [])
    {
        $date = $this->extractValue($field, $model);
        if (!$date) {
            return "-";
        }
        return $date->format('d M Y à h:m');
    }
    protected function formatDateShort(string $field, ?Model $model = null, array $options = [])
    {
        $date = $this->extractValue($field, $model);
        if (!$date) {
            return "-";
        }
        return $date->format('d/m/y h:m');
    }

    protected function extractValue(string $field, ?Model $model = null, mixed $default = null)
    {
        $res = data_get($model, $field, $default);
        return $res;
    }

    protected function buildOptions(array $data): array
    {
        $options = [];
        foreach ($data as $key => $value) {
            if (is_numeric($key) && is_string($value)) {
                // only a string was passed
                // ['foor', 'bar', ...]
                $options[$value] = $this->buildOptionsFromString($value);
                continue;
            }
            if (is_string($value) && is_string($value)) {
                // we have a key value
                // ['foo' => 'bar', ....] 
                $options[$key] = $this->buildOptionsFromKeyValue($key, $value);
                continue;
            }
            // we have a configuration array
            // ['foo' => [....]]
            $options[$key] = $value;
        }
        return $options;
    }

    protected function buildOptionsFromKeyValue(string $key, string $value): array
    {
        return [
            'format' => $this->guessDefaultFormat($key),
            'title' => $value
        ];
    }

    protected function buildOptionsFromString(string $value): array
    {
        return [
            'format' => $this->guessDefaultFormat($value),
            'title' => strlen($value) < 3 ? $value : str($value)->headline()->lower()->ucfirst()->toString()
        ];
    }


    protected function guessDefaultFormat(string $field): string
    {
        return match (true) {
            str_ends_with($field, 'amount') || str_ends_with($field, 'price') => 'money',
            str_ends_with($field, '_at') => 'date',
            default => 'none',
        };
    }

}