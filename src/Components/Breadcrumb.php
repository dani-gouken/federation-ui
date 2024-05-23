<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array|string $name, public ?Model $model = null)
    {
        if (is_array($name) && (count($name) == 2)) {
            $this->name = $name[0];
            $this->model = $name[1];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.breadcrumb');
    }
}
