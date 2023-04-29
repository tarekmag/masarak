<?php

namespace ATPGroup\Routes\Views\Components;

use App\Enums\RouteType;
use Illuminate\View\Component;

class DropdownLocationEmployeeRequestStatus extends Component
{
    protected $scheduleStatus;
    protected $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($scheduleStatus, $required)
    {
        $this->scheduleStatus = $scheduleStatus;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['status'] = [
            // RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_PENDING, 
            RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_APPROVED, 
            RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_DECLINED
            ];
        $data['scheduleStatus'] = $this->scheduleStatus;
        $data['required'] = $this->required;
        return view('route::components.dropdown-location-employee-request-status')->with($data);
    }
}
