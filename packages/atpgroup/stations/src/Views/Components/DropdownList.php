<?php

namespace ATPGroup\Stations\Views\Components;

use ATPGroup\Stations\Models\Station;
use Illuminate\View\Component;

class DropdownList extends Component
{
    protected $stationId;
    protected $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($stationId, $required)
    {
        $this->station_id = $stationId;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['stations'] = Station::all();
        $data['stationId'] = $this->station_id;
        $data['required'] = $this->required;
        return view('station::components.dropdown-list')->with($data);
    }
}
