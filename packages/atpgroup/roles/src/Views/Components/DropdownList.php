<?php

namespace ATPGroup\Roles\Views\Components;

use ATPGroup\Roles\Models\Role;
use Illuminate\View\Component;

class DropdownList extends Component
{
    protected $roleId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($roleId)
    {
        $this->role_id = $roleId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['roles'] = Role::all();
        $data['roleId'] = $this->role_id;
        return view('role::components.dropdown-list')->with($data);
    }
}
