<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StateCheckboxGroup extends Component
{
    public $id;
    public $inputOneName;
    public $classOne;
    public $classTwo;
    public $labelText;
    public $dataList;
    public $listInputIdFor;
    public $listInputName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id,
        $inputOneName,
        $labelText,
        $classOne,
        $classTwo,
        $dataList,
        $listInputIdFor,
        $listInputName
    ) {
        $this->id = $id;
        $this->inputOneName = $inputOneName;
        $this->classOne = $classOne;
        $this->classTwo = $classTwo;
        $this->labelText = $labelText;
        $this->dataList = $dataList;
        $this->listInputIdFor = $listInputIdFor;
        $this->listInputName = $listInputName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.state-checkbox-group');
    }
}
