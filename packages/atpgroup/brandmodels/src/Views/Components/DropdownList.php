<?php

namespace ATPGroup\BrandModels\Views\Components;

use Illuminate\View\Component;
use ATPGroup\BrandModels\Models\BrandModel;

class DropdownList extends Component
{
    protected $brandId;
    protected $brandModelId;
    protected $required;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($brandId, $brandModelId, $required, $name)
    {
        $this->brand_id = ($brandId) ? $brandId : 0 ;
        $this->brand_model_id = $brandModelId;
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
        $data['brandId'] = $this->brand_id;
        $data['brandModelId'] = $this->brand_model_id;
        $data['required'] = $this->required;
        $data['name'] = $this->name;
        $data['brandModels'] = BrandModel::where('brand_id', $this->brand_id)->get();
        return view('brandModel::components.dropdown-list')->with($data);
    }
}
