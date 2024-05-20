<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $description = "",
        public string $theme = "dark",
        public string $floatingText = "",
        public string $floatingTextTheme = "danger",
        public ?string $icon = null,
        public bool $iconGhost = false,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.stat-card');
    }
}
