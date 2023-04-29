<?php

namespace ATPGroup\Suppliers\Views\Components;

use ATPGroup\Suppliers\Models\Supplier;
use Illuminate\View\Component;

class DropdownList extends Component
{
    protected $supplierId;
    protected $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($supplierId, $required)
    {
        $this->supplier_id = $supplierId;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['suppliers'] = Supplier::all();
        $data['supplierId'] = $this->supplier_id;
        $data['required'] = $this->required;
        return view('supplier::components.dropdown-list')->with($data);
    }
}
