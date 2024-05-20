<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array|Collection $options,
        public string|\BackedEnum|null|array|Collection $selected = null,
        public ?string $label = "",
        public ?string $modelNameField = null,
        public string $placeholder = "",
        public bool $required = true,
        public bool $multiple = false,
        public bool $disabled = false,
        public bool $noMargin = false,
        public string $empty = "",
    ) {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value instanceof \BackedEnum) {
                $options[] = ["name" => method_exists($value, 'format') ? $value->format() : $value->name, "value" => $value->value];
                continue;
            }
            if ($value instanceof Model) {
                $options[] = ["name" => $modelNameField ? $value->$modelNameField : $value->name, "value" => $value->id];
                continue;
            }
            $options[] = ["name" => $value, "value" => $key];
        }
        if ($this->selected instanceof \BackedEnum) {
            $this->selected = $this->selected->value;
        }
        if ($this->selected instanceof Collection) {
            $formattedSelected = [];
            foreach ($this->selected as $key => $value) {
                $formattedSelected[] = $value->id;
                continue;
            }
            $this->selected = $formattedSelected;
        }
        $this->options = $options;
        $this->selected = old($name, $this->selected);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.select');
    }
}