<?php

namespace Federation\UI\Components\DataTable;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;
    public DataTableInfo $info;

    #[Url]
    public int $perPage = 15;

    #[Url]
    public string $query = "";

    public function render()
    {
        $builder = $this->info->model::datatable($this->query, request());
        if (!($builder instanceof Builder)) {
            throw new \InvalidArgumentException("the {$this->info->model}::datatable should return an eloquent query builder ");
        }
        $requestQuery = $this->query;
        $pagination = $builder->latest()->paginate($this->perPage);
        return view('f::livewire.data-table', compact("pagination", "requestQuery"));
    }

    public function updated($property)
    {
        if ($property === 'perPage') {
            $this->resetPage();
        }
    }

    public function paginationView()
    {
        return 'livewire::bootstrap';
    }

}
