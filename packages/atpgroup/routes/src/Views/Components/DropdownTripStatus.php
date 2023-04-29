<?php

namespace ATPGroup\Routes\Views\Components;

use App\Enums\RouteType;
use Illuminate\View\Component;

class DropdownTripStatus extends Component
{
    protected $tripStatus;
    protected $required;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tripStatus, $required, $name)
    {
        $this->trip_type = $tripStatus;
        $this->required = $required;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['statuss'] = [RouteType::TRIP_STATUS_AVAILABLE, RouteType::TRIP_STATUS_NOT_STARTED, RouteType::TRIP_STATUS_STARTED, RouteType::TRIP_STATUS_COMPLETED, RouteType::TRIP_STATUS_CANCELLED, RouteType::TRIP_STATUS_STOPPED];
        $data['tripStatus'] = $this->trip_type;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        return view('route::components.dropdown-trip-status')->with($data);
    }
}
