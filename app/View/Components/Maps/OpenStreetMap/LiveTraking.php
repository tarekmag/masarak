<?php

namespace App\View\Components\Maps\OpenStreetMap;

use Illuminate\View\Component;

class LiveTraking extends Component
{
    protected $tripId;
    protected $coordinates;
    protected $stations;
    protected $zoom;
    protected $width;
    protected $height;
    protected $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tripId, $coordinates, $stations, $zoom, $width, $height, $icon = 'map/images/marker-icon.png')
    {
        $this->tripId = $tripId;
        $this->coordinates = $coordinates;
        $this->stations = $stations;
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
        $data['tripId'] = $this->tripId;
        $data['coordinates'] = $this->coordinates;
        $data['stations'] = $this->stations;
        $data['zoom'] = $this->zoom;
        $data['width'] = $this->width;
        $data['height'] = $this->height;
        $data['icon'] = $this->icon;
        return view('components..maps.open-street-map.live-traking')->with($data);
    }
}
