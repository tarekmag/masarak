<?php

namespace ATPGroup\Routes\Views\Components;

use Illuminate\View\Component;

class EmployeeLocationRequestsStatus extends Component
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
        return view('route::components.employee-location-requests-status')->with($data);
    }
}
