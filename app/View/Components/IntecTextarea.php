<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IntecTextarea extends Component
{
    public $labelText;
    public $textareaType;
    public $labelTextareaId;
    public $textareaName;
    public $classOne;
    public $labelClass;
    public $textareaValue;
    public $textareaReadonly;
    public $rows;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $labelText,
        $textareaType,
        $labelTextareaId,
        $textareaName,
        $classOne,
        $labelClass,
        $textareaValue,
        $textareaReadonly,
        $rows,
    ) {
        $this->labelText = $labelText;
        $this->textareaType = $textareaType;
        $this->labelTextareaId = $labelTextareaId;
        $this->textareaName = $textareaName;
        $this->classOne = $classOne;
        $this->labelClass = $labelClass;
        $this->textareaValue = $textareaValue;
        $this->textareaReadonly = $textareaReadonly;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.intec-textarea');
    }
}
