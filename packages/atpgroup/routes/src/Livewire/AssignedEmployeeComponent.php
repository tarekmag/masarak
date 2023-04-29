<?php

namespace ATPGroup\Routes\Livewire;

use ATPGroup\Employees\Models\Employee;
use ATPGroup\Routes\Models\Route;
use Livewire\Component;
use ATPGroup\Routes\Models\RouteScheduleEmployee;
use ATPGroup\Stations\Models\Station;

class AssignedEmployeeComponent extends Component
{
    public $routeId = null;
    public $scheduleId = null;

    public $employeesTable, $employeesList, $stationsList, $employee_id, $station_id, $id;
    public $isOpen = 0;
    public $deleteId = 0;

    public function __construct($routeId, $scheduleId = null)
    {
        $this->routeId = $routeId;
        $this->scheduleId = $scheduleId;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $route = Route::find($this->routeId);
        $this->employeesTable = RouteScheduleEmployee::where('route_id', $this->routeId)->where('route_schedule_id', $this->scheduleId)->get();
        // $this->employeesList = app(TripService::class)->getAllEmployeesNotAssignToStation($route, $this->scheduleId);
        $this->employeesList = Employee::where('company_id', $route->company_id)->where('branch_id', $route->branch_id)->whereNotIn('id', $this->employeesTable->pluck('employee_id')->toArray())->get();
        $this->stationsList = Station::findMany($route->stations->pluck('station_id')->toArray());
        return view('livewire.route.assigned-employee.index');
    }

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->employee_id = '';
        $this->station_id = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'employee_id' => 'required',
            'station_id' => 'sometimes|nullable'
        ]);
   
        RouteScheduleEmployee::updateOrCreate(['route_id' => $this->routeId, 'route_schedule_id' => $this->scheduleId, 'employee_id' => $this->employee_id], [
            'station_id' => $this->station_id
        ]);
  
        $this->closeModal();
        $this->resetInputFields();

        session()->flash('toastrSuccess', __('route::language.assignEmployee.message.updated'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function deleteId($id)
    {
        $this->deleteId = $id;
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete()
    {
        RouteScheduleEmployee::find($this->deleteId)->delete();
        session()->flash('toastrSuccess', __('route::language.assignEmployee.message.deleted'));
    }
}
