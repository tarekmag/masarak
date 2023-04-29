<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormToggle extends Component
{
    protected $isActive;
    protected $name;
    protected $iconOn;
    protected $iconOff;
    protected $colorOn;
    protected $colorOff;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($isActive, $name, $iconOn, $iconOff, $colorOn, $colorOff)
    {
        $this->isActive = $isActive;
        $this->name = $name;
        $this->iconOn = $iconOn;
        $this->iconOff = $iconOff;
        $this->colorOn = $colorOn;
        $this->colorOff = $colorOff;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['isActive'] = $this->isActive;
        $data['name'] = $this->name;
        $data['iconOn'] = $this->iconOn;
        $data['iconOff'] = $this->iconOff;
        $data['colorOn'] = $this->colorOn;
        $data['colorOff'] = $this->colorOff;
        return view('components.form-toggle')->with($data);
    }
}
