<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CustomAction extends Component
{
    protected $title;
    protected $routeName;
    protected $icon;
    protected $color;
    protected $target;
    protected $dataMethod;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $routeName, $icon, $color, $target, $dataMethod)
    {
        $this->title = $title;
        $this->routeName = $routeName;
        $this->icon = $icon;
        $this->color = $color;
        $this->target = $target;
        $this->dataMethod = $dataMethod;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['title'] = $this->title;
        $data['routeName'] = $this->routeName;
        $data['icon'] = $this->icon;
        $data['color'] = $this->color;
        $data['target'] = $this->target;
        $data['dataMethod'] = $this->dataMethod;
        return view('components.custom-action')->with($data);
    }
}
