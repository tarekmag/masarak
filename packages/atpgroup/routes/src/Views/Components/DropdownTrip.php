<?php

namespace ATPGroup\Routes\Views\Components;

use App\Enums\RouteType;
use ATPGroup\Routes\Models\Trip;
use Illuminate\View\Component;

class DropdownTrip extends Component
{
    protected $tripIds;
    protected $statuss;
    protected $selected;
    protected $required;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tripIds, $statuss, $selected, $required, $name)
    {
        $this->trip_ids = $tripIds;
        $this->statuss = $statuss;
        $this->selected = $selected;
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
        $data['trips'] = Trip::whereIn('status', $this->statuss)->get();
        $data['tripIds'] = $this->trip_ids;
        $data['selected'] = $this->selected;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        return view('route::components.dropdown-trip')->with($data);
    }
}
