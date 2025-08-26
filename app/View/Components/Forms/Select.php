<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $label;
    public $options;
    public $cols;
    public $selected;
    /**
     * Create a new component instance.
     */
    public function __construct(string $name,string $label = "",string $selected = '', string $cols = '12', $options = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->cols = $cols;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}
