<?php

namespace ATPGroup\Routes\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use ATPGroup\Routes\Models\Trip;

class TripsTableComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $routeId = null;
    public $scheduleId = null;
    public $scheduleType = null;

    public function __construct($routeId, $scheduleId = null, $scheduleType = null)
    {
        $this->routeId = $routeId;
        $this->scheduleId = $scheduleId;
        $this->scheduleType = $scheduleType;
    }

    public function render()
    {
        $data['trips'] = Trip::where('route_id', (int) $this->routeId)
            ->when($this->scheduleId, function ($query) {
                return $query->where('route_schedule_id', (int) $this->scheduleId);
            })
            ->when($this->scheduleType, function ($query) {
                return $query->where('type', $this->scheduleType);
            })
            ->orderBy('trip_time', 'DESC')
            ->paginate(config('helpers.paginate'));
        return view('livewire.route.trips-table')->with($data);
    }
}
