<?php

namespace ATPGroup\Drivers\Views\Components;

use Illuminate\View\Component;

class DriverHtmlStatus extends Component
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
        return view('driver::components.driver-html-status')->with($data);
    }
}
