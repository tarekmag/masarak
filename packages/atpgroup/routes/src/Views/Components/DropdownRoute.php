<?php

namespace ATPGroup\Routes\Views\Components;

use ATPGroup\Routes\Models\Route;
use Illuminate\View\Component;

class DropdownRoute extends Component
{
    protected $routeId;
    protected $required;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($routeId, $required, $name)
    {
        $this->route_id = $routeId;
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
        $data['routes'] = Route::all();
        $data['routeId'] = $this->route_id;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        return view('route::components.dropdown-route')->with($data);
    }
}
