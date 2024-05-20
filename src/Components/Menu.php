<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public array $items,
        public string $theme = 'dark',
        public array $userDropdownItems = [],
        public ?string $logoutUrl = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.menu');
    }
}
