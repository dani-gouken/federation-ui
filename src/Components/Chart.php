<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Chart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public int $height = 280,
        public array $options = []
    ) {
        $this->options =
            [
                "chart" => array_merge([
                    "type" => "line",
                    "fontFamily" => 'inherit',
                    "height" => $height,
                    "toolbar" => [
                        "show" => false,
                    ],
                    "animations" => [
                        "enabled" => false
                    ],
                ], $this->options['chart'] ?? []),
                "fill" => array_merge([
                    "opacity" => 1,
                ], $this->options['fill'] ?? []),
                "stroke" => array_merge([
                    "width" => 2,
                    "lineCap" => "round",
                    "curve" => "smooth",
                ], $this->options['stroke'] ?? []),
                "tooltip" => array_merge([
                    "theme" => 'dark'
                ], $this->options['tooltip'] ?? []),
                "grid" => array_merge([
                    "padding" => [
                        "top" => -20,
                        "right" => 0,
                        "left" => -4,
                        "bottom" => -4
                    ],
                    "strokeDashArray" => 4,
                ], $this->options['grid'] ?? []),
                "xaxis" => array_merge([
                    "labels" => [
                        "padding" => 0,
                    ],
                    "tooltip" => [
                        "enabled" => false
                    ],
                ], $this->options['xaxis'] ?? []),
                "yaxis" => array_merge([
                    "labels" => [
                        "padding" => 4
                    ],
                ], $this->options['yaxis'] ?? []),
                ...(isset($this->options['plotOptions']) ? ["plotOptions" => $this->options['plotOptions']] : []),
                ...(isset($this->options['dataLabels']) ? ["dataLabels" => $this->options['dataLabels']] : []),
                ...(isset($this->options['colors']) ? ["colors" => $this->options['colors']] : []),
                'series' => ($this->options['series'] ?? []),
                'labels' => ($this->options['labels'] ?? []),
                "legend" => array_merge([
                    'show' => false,
                    'position' => 'bottom',
                    'offsetY' => 12,
                    'markers' => [
                        'width' => 10,
                        'height' => 10,
                        'radius' => 100,
                    ],
                    'itemMargin' => [
                        'horizontal' => 8,
                        'vertical' => 8
                    ],
                ], ($this->options['legend'] ?? [])),
            ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.chart');
    }
}
