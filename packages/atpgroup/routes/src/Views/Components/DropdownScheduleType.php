<?php

namespace ATPGroup\Routes\Views\Components;

use App\Enums\RouteType;
use Illuminate\View\Component;

class DropdownScheduleType extends Component
{
    protected $scheduleType;
    protected $required;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($scheduleType, $required, $name)
    {
        $this->schedule_type = $scheduleType;
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
        $data['types'] = [RouteType::SCHEDULE_SCHEDULED, RouteType::SCHEDULE_SPECIAL_REQUEST];
        $data['scheduleType'] = $this->schedule_type;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        return view('route::components.dropdown-schedule-type')->with($data);
    }
}
