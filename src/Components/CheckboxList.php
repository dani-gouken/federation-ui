<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CheckboxList extends Component
{
    public array $checked = [];
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $description = "",
        public string $name = "",
        public string $value = "",
        public array|\Illuminate\Support\Collection $items = [],
        array|Collection $checked = [],

    ) {
        if($checked instanceof Collection) {
            $this->checked = $checked->pluck('id')->toArray();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.checkbox-list');
    }
}
