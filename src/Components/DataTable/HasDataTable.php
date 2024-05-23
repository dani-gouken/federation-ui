<?php

namespace Federation\UI\Components\DataTable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait HasDataTable
{
    public static string $datatableSearchField = "name";

    public static function datatable(string $query): Builder
    {
        $builder = self::query();
        $field = self::$datatableSearchField;
        if (!empty($query)) {
            $builder->where($field, "LIKE", "%$query%");
        }
        return $builder;
    }

    public function datatableActions(Request $request): array
    {
        return [
            [
                "name" => "Voir",
                "icon" => "eye",
                "theme" => "primary",
                "url" => dashboard_route("show", $this)
            ],
            ["name" => "Edit.", "icon" => "edit", "theme" => "default", "url" => dashboard_route("edit", $this)],
            [
                "name" => "Suppr.",
                "icon" => "trash",
                "theme" => "danger",
                "confirmed" => true,
                "method" => "delete",
                "url" => dashboard_route("destroy", $this)
            ]
        ];
    }
}
