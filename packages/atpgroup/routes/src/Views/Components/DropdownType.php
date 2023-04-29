<?php

namespace ATPGroup\Routes\Views\Components;

use App\Enums\RouteType;
use Illuminate\View\Component;

class DropdownType extends Component
{
    protected $routeType;
    protected $required;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($routeType, $required, $name)
    {
        $this->route_type = $routeType;
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
        $data['types'] = [RouteType::ECONOMY, RouteType::BUSINESS];
        $data['routeType'] = $this->route_type;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        return view('route::components.dropdown-type')->with($data);
    }
}
