<?php

namespace ATPGroup\Routes\Views\Components;

use Illuminate\View\Component;

class TripHtmlStatus extends Component
{
    protected $status;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['status'] = $this->status;
        return view('route::components.trip-html-status')->with($data);
    }
}
