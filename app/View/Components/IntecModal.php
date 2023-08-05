<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IntecModal extends Component
{
    public $id;
    public $route;
    public $ariaLabelledby;
    public $title;
    public $collection;
    public $submitButtonClass;
    public $submitButtonText;
    public $size;
    public $httpMethod;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id,
        $route,
        $ariaLabelledby,
        $title,
        $collection,
        $submitButtonClass,
        $submitButtonText,
        $size,
        $httpMethod,
    ) {
        $this->id = $id;
        $this->route = $route;
        $this->ariaLabelledby = $ariaLabelledby;
        $this->title = $title;
        $this->collection = $collection;
        $this->submitButtonClass = $submitButtonClass;
        $this->submitButtonText = $submitButtonText;
        $this->size = $size;
        $this->httpMethod = $httpMethod;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.intec-modal');
    }
}
