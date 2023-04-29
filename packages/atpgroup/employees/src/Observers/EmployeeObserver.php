<?php

namespace ATPGroup\Employees\Observers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use ATPGroup\Stations\Models\Station;
use ATPGroup\Employees\Models\Employee;

class EmployeeObserver
{
    /**
     * Handle the Employee "creating" event.
     *
     * @param  \ATPGroup\Employees\Models\Employee  $employee
     * @return void
     */
    public function creating($employee)
    {
        $request = request();

        if($request->filled('is_leader'))
        {
            $request->merge(['is_leader' => true]);
        }

        $employee->fill($request->all());
    }

    /**
     * Handle the Employee "updating" event.
     *
     * @param  \ATPGroup\Employees\Models\Employee  $employee
     * @return void
     */
    public function saving($employee)
    {
        $request = request();
        if($request->filled('is_leader'))
        {
            $request->merge(['is_leader' => true]);
        }else{
            $request->merge(['is_leader' => false]);
        }
        $employee->fill($request->all());
    }

    /**
     * Handle the Employee "saved" event.
     *
     * @param  \ATPGroup\Employees\Models\Employee  $employee
     * @return void
     */
    public function saved($employee)
    {
        $request = request();
        //app(EmployeeService::class)->updateLeaderOtherEmployee($request, $employee);
    }

    /**
     * Handle the Employee "deleting" event.
     *
     * @param  \ATPGroup\Employees\Models\Employee  $employee
     * @return void
     */
    public function deleting($employee)
    {
        //
    }

}
