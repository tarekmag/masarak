<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Loader extends Component
{
    protected $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['id'] = $this->id;
        return view('components.loader')->with($data);
    }
}
