<?php

namespace ATPGroup\Vehicles\Views\Components;

use App\Enums\VehicleType;
use Illuminate\View\Component;

class DropdownDocumentType extends Component
{
    protected $type;
    protected $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $required)
    {
        $this->type = $type;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['types'] = [VehicleType::DOC_LICENSE, VehicleType::DOC_FA7S];
        $data['type'] = $this->type;
        $data['required'] = $this->required;
        return view('vehicle::components.dropdown-document-type')->with($data);
    }
}
