<?php

namespace ATPGroup\Emergencies\Views\Components;

use ATPGroup\Emergencies\Models\Emergency;
use Illuminate\View\Component;

class DropdownEmergency extends Component
{
    protected $emergencyId;
    protected $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($emergencyId, $required)
    {
        $this->emergency_id = $emergencyId;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['emergencyId'] = $this->emergency_id;
        $data['required'] = $this->required;
        $data['emergencies'] = Emergency::active()->get();
        return view('emergency::components.dropdown-emergency')->with($data);
    }
}
