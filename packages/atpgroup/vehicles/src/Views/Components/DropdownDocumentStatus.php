<?php

namespace ATPGroup\Vehicles\Views\Components;

use App\Enums\VehicleType;
use Illuminate\View\Component;

class DropdownDocumentStatus extends Component
{
    protected $status;
    protected $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($status, $required)
    {
        $this->status = $status;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['statuses'] = [VehicleType::DOC_PENDING, VehicleType::DOC_APPROVED, VehicleType::DOC_DECLINED];
        $data['status'] = $this->status;
        $data['required'] = $this->required;
        return view('vehicle::components.dropdown-document-status')->with($data);
    }
}
