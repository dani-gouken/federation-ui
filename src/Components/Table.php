<?php

namespace Federation\UI\Components;

use Federation\UI\DataFormatter;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Table extends Component
{
    use DataFormatter;
    public array $fields = [];
    public $info;
    public bool $isCollection = false;
    /**
     * Create a new component instance.
     */
    public function __construct(array $fields, $info)
    {
        $this->info = $info;
        $this->isCollection = $info instanceof Collection;
        $this->fields = $this->buildOptions($fields);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.table', ['format' => $this->format(...)]);
    }
}
