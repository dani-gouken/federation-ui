<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type = "submit",
        public string $variant = "primary",
        public string $tag = "button",
        public bool $disabled = false,
        public bool $ghost = false,
        public bool $small = false,
        public ?string $icon = null,
        public ?string $href = null,
        public ?string $onclick = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.button');
    }
}