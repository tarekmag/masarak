<?php

namespace ATPGroup\Routes\Views\Components;

use App\Enums\RouteType;
use Illuminate\View\Component;

class ListWeekdays extends Component
{
    protected $days;
    protected $required;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($days, $required, $name)
    {
        $this->days = $days;
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
        $data['weekdays'] = [
            RouteType::SUNDAY,
            RouteType::MONDAY,
            RouteType::TUESDAY,
            RouteType::WEDNESDAY,
            RouteType::THURSDAY,
            RouteType::FRIDAY,
            RouteType::SATURDAY, 
        ];
        $data['days'] = $this->days;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        return view('route::components.list-weekdays')->with($data);
    }
}
