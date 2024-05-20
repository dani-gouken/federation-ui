<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $value = null,
        public string $type = "text",
        public string $label = "",
        public string $placeholder = "",
        public string $suffix = "",
        public string $suffixAttr = "",
        public bool $noMargin = false,
        public bool $required = true,
        public bool $disabled = false,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.input');
    }
}