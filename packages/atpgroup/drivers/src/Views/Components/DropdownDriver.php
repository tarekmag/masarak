<?php

namespace ATPGroup\Drivers\Views\Components;

use ATPGroup\Drivers\Models\Driver;
use Illuminate\View\Component;

class DropdownDriver extends Component
{
    protected $driverId;
    protected $required;
    protected $supplierId;
    protected $get_all;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($driverId, $required, $supplierId = null, $getAll = true, $name)
    {
        $this->driver_id = $driverId;
        $this->required = $required;
        $this->supplier_id = $supplierId;
        $this->get_all = $getAll;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['driverId'] = $this->driver_id;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        $data['drivers'] = Driver::active()->when(!$this->get_all, function($query){
            return $query->whereNull('supplier_id');
        })
        ->when($this->supplier_id, function($query){
            return $query->where('supplier_id', $this->supplier_id);
        })->get();
        return view('driver::components.dropdown-driver')->with($data);
    }
}
