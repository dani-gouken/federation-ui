<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $name, public string $size = "h2")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.icon');
    }
}
