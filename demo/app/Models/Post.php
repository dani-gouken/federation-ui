<?php

namespace App\Models;

use Federation\UI\Components\DataTable\HasDataTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasDataTable;
    public static string $datatableSearchField = "name";
    public function datatableActions(): array
    {
        return [];
    }
}
