<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toggle extends Component
{
    protected $isActive;
    protected $url;
    protected $dataMethod;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($isActive, $url, $dataMethod)
    {
        $this->isActive = $isActive;
        $this->url = $url;
        $this->dataMethod = $dataMethod;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['isActive'] = $this->isActive;
        $data['url'] = $this->url;
        $data['dataMethod'] = $this->dataMethod;
        return view('components.toggle')->with($data);
    }
}
