<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $dark = false
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.logo');
    }
}
