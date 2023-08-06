<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IntecSelect extends Component
{
    public $selectName;
    public $selectLabel;
    public $selectClass;
    public $required;
    public $placeholder;
    public $collection;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $selectName,
        $selectLabel,
        $selectClass,
        $required,
        $placeholder,
        $collection,
        $value
    ) {
        $this->selectName = $selectName;
        $this->selectLabel = $selectLabel;
        $this->selectClass = $selectClass;
        $this->required = $required;
        $this->placeholder = $placeholder;
        $this->collection = $collection;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.intec-select');
    }
}
