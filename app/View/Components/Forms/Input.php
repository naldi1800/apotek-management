<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{

    public $type;
    public $name;
    public $value;
    public $label;
    public $cols;
    public $hidden;
    public $disabled;
    public $help;
    public $isLivewire = false;
    public $min;
    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $type = 'text', string $value = '', string $label = '', string $cols = '12', bool $hidden = false, bool $disabled = false, string $help = '', $isLivewire = "0", $min = '0')
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->cols = $cols;
        $this->hidden = $hidden;
        $this->disabled = $disabled;
        $this->help = $help;
        $this->isLivewire = $isLivewire == "1";
        $this->min = $min;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input');
    }
}
