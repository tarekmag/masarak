<?php

namespace ATPGroup\Vehicles\Views\Components;

use Illuminate\View\Component;
use ATPGroup\Vehicles\Models\Vehicle;
use ATPGroup\Drivers\Models\DriverVehicle;

class DropdownVehicle extends Component
{
    protected $driverId;
    protected $vehicleId;
    protected $required;
    protected $name;
    protected $isMultiple;
    protected $showAll;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($driverId, $vehicleId, $required, $name, $isMultiple = false, $showAll = false)
    {
        $this->driver_id = $driverId;
        $this->vehicle_id = $vehicleId;
        $this->required = $required;
        $this->name = $name;
        $this->isMultiple = $isMultiple;
        $this->showAll = $showAll;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['driverId'] = $this->driver_id;
        $data['vehicleId'] = $this->vehicle_id;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        $data['isMultiple'] = $this->isMultiple;
        $data['showAll'] = $this->showAll;
        $data['vehicles'] = Vehicle::active()->with(['driverVehicles'])->when($this->showAll == false, function ($query) {
            return $query->whereHas('driverVehicles', function($q){
                return $q->where('driver_id', $this->driver_id);
            });
        })->get()->map(function ($item) {
            return ['id' => $item->id, 'name' => $item->id . ' - ' . $item->plate_number];
        });
        return view('vehicle::components.dropdown-vehicle')->with($data);
    }
}
