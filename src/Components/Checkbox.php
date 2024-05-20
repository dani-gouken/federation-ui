<?php

namespace Federation\UI\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $description = "",
        public string $name = "",
        public string $value = "",
        public bool $checked = false,
        public bool $list = false,
        ?Model $model = null,
    ) {
        if ($model == null) {
            return;
        }
        $this->title = $model->$title;
        if(!empty($this->description)) {
            $this->description = $model->$description;
        }
        if(!empty($this->value)) {
            $this->value = $model->$value;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('f::components.checkbox');
    }
}
