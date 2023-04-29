<?php

namespace ATPGroup\Districts\Views\Components;

use ATPGroup\Districts\Models\District;
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
    public function __construct($districtId, $required)
    {
        $this->district_id = $districtId;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['districts'] = District::all();
        $data['districtId'] = $this->district_id;
        $data['required'] = $this->required;
        return view('district::components.dropdown-list')->with($data);
    }
}
