<?php
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('enum_cases_to_string_array')) {
    /**
     * @param array<\BackedEnum> $cases
     * @return array<string>
     **/
    function enum_cases_to_string_array(array $cases): array
    {
        return array_map(fn(\UnitEnum|\BackedEnum $enum) => $enum->name, $cases);
    }
}
if (!function_exists('dashboard_route')) {
    /**
     * @template T
     * @param T|class-string<T> $model
     **/
    function dashboard_route(string $route, string|object ...$models): string
    {
        $params = [];
        foreach ($models as $model) {
            $modelClass = is_string($model) ? $model : $model::class;
            $routeName = str($modelClass)->classBasename()->kebab()->lower()->toString();
            if (!is_string($model)) {
                $params[] = $model;
            }
        }
        $name = "dashboard.$routeName.$route";
        $route = Route::getRoutes()->getByName($name);
        $variables = $route?->compiled?->getPathVariables();
        if ($variables && count($variables) != count($params) && is_object($models[0])) {
            $model = $models[0];
            $newParams = [];
            $failed = false;
            for ($i = 0; $i < count($variables) - 1; $i++) {
                $var = $variables[$i];
                $res = request()->$var ?? null;
                if (!$res) {
                    $res = data_get($model, $variables[$i]);
                }
                if ($res instanceof Model) {
                    $newParams[] = $res;
                } else {
                    $failed = true;
                    break;
                }
            }
            if (!$failed) {
                $newParams[] = $model;
                $params = $newParams;
            }
        }
        return route($name, $params);
    }
}

if (!function_exists('enum_to_states')) {
    /**
     * @param array<BackedEnum> $cases
     * @return array<string>
     **/
    function enum_cases_values(array $cases): array
    {
        return array_map(fn(\BackedEnum $case) => $case->value, $cases);
    }
}

if (!function_exists('current_user')) {
    /**
     * @return User|null
     **/
    function current_user(): ?User
    {
        /** @var User|null */
        $user = auth()->user();
        return $user;
    }
}
if (!function_exists('format_remove_reference_format')) {
    function format_remove_reference_format(array $fields): array
    {
        return array_map(function (array|string $data) {
            if (is_string($data)) {
                return $data;
            }
            if (isset ($data['format']) && $data['format'] == 'relation') {
                $data['format'] = 'none';
            }
            return $data;
        }, $fields);
    }
}