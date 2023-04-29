<?php

namespace ATPGroup\Drivers\Views\Components;

use App\Enums\DriverType;
use Illuminate\View\Component;

class DropdownType extends Component
{
    protected $driverType;
    protected $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($driverType, $required)
    {
        $this->driver_type = $driverType;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['types'] = [DriverType::INDIVIDUAL, DriverType::SUPPLIER];
        $data['driverType'] = $this->driver_type;
        $data['required'] = $this->required;
        return view('driver::components.dropdown-type')->with($data);
    }
}
