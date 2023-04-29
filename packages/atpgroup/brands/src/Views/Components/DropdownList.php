<?php

namespace ATPGroup\Brands\Views\Components;

use ATPGroup\Brands\Models\Brand;
use Illuminate\View\Component;

class DropdownList extends Component
{
    protected $brandId;
    protected $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($brandId, $required)
    {
        $this->brand_id = $brandId;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data['brands'] = Brand::all();
        $data['brandId'] = $this->brand_id;
        $data['required'] = $this->required;
        return view('brand::components.dropdown-list')->with($data);
    }
}
