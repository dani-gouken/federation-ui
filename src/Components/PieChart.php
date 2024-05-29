<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PieChart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public array $series = [],
        public int $height = 280,
        public array $labels = [],
        public array $options = [],
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
                'legend' => [
                    'show' => true,
                ],
                "chart" => [
                    "type" => "donut",
                    "sparkline" => [
                        "enabled" => true
                    ],
                ],
                'labels' => $this->labels,
                'series' => $this->series,
            ], $this->options)
        ]);
    }
}
