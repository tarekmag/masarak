<?php

namespace App\View\Components\Maps\OpenStreetMap;

use Illuminate\View\Component;

class AddMarker extends Component
{
    protected $lat;
    protected $lng;
    protected $zoom;
    protected $width;
    protected $height;
    protected $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($lat, $lng, $zoom, $width, $height, $icon = 'map/images/marker-icon.png')
    {
        $this->lat = $lat;
        $this->lng = $lng;
        $this->zoom = $zoom;
        $this->width = $width;
        $this->height = $height;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['lat'] = $this->lat;
        $data['lng'] = $this->lng;
        $data['zoom'] = $this->zoom;
        $data['width'] = $this->width;
        $data['height'] = $this->height;
        $data['icon'] = $this->icon;
        return view('components..maps.open-street-map.add-marker')->with($data);
    }
}
