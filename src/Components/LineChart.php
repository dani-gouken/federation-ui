<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LineChart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public array $labels = [],
        public array $series = [],
        public array $options = [],
        public int $height = 280,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.generic-chart', [
            'overridedOptions' => array_merge_recursive([
                'labels' => $this->labels,
                'series' => $this->series,
            ], $this->options)
        ]);
    }
}
