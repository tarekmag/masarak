<?php

namespace ATPGroup\Companies\Views\Components;

use ATPGroup\Companies\Models\Company;
use Illuminate\View\Component;

class DropdownBranch extends Component
{
    protected $companyId;
    protected $branchId;
    protected $required;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($companyId, $branchId, $required, $name)
    {
        $this->company_id = ($companyId) ? $companyId : 0 ;
        $this->branch_id = $branchId;
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
        $data['branchId'] = $this->branch_id;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        $data['companies'] = Company::where('parent_id', $this->company_id)->get();
        return view('company::components.dropdown-branch')->with($data);
    }
}
