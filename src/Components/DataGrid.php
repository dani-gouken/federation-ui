<?php

namespace Federation\UI\Components;

use Federation\UI\DataFormatter;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataGrid extends Component
{
    use DataFormatter;
    public array $fields = [];
    public object $info;

    /**
     * Create a new component instance.
     */
    public function __construct(array $fields, $info)
    {
        $this->info = $info;
        $this->fields = $this->buildOptions($fields);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.data-grid', ['format' => $this->format(...)]);
    }
}
