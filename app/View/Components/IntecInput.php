<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IntecInput extends Component
{
    public $labelText;
    public $inputType;
    public $labelInputId;
    public $inputName;
    public $classOne;
    public $inputValue;
    public $inputReadonly;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $labelText,
        $inputType,
        $labelInputId,
        $inputName,
        $classOne,
        $inputValue,
        $inputReadonly
    ) {
        $this->labelText = $labelText;
        $this->inputType = $inputType;
        $this->labelInputId = $labelInputId;
        $this->inputName = $inputName;
        $this->classOne = $classOne;
        $this->inputValue = $inputValue;
        $this->inputReadonly = $inputReadonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.intec-input');
    }
}
