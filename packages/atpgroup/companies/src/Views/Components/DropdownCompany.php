<?php

namespace ATPGroup\Companies\Views\Components;

use ATPGroup\Companies\Models\Company;
use Illuminate\View\Component;

class DropdownCompany extends Component
{
    protected $companyId;
    protected $required;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($companyId, $required, $name)
    {
        $this->company_id = $companyId;
        $this->required = $required;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['companyId'] = $this->company_id;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        $data['companies'] = Company::parent()->get();
        return view('company::components.dropdown-company')->with($data);
    }
}
