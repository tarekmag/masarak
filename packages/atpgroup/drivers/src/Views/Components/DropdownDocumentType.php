<?php

namespace ATPGroup\Drivers\Views\Components;

use App\Enums\DriverType;
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
        $data['types'] = [DriverType::DOC_PERSONAA_DRIVING_LICENSE, DriverType::DOC_FEESH_WE_TASHBEEH, DriverType::DOC_DRUG_REPORT];
        $data['type'] = $this->type;
        $data['required'] = $this->required;
        return view('driver::components.dropdown-document-type')->with($data);
    }
}
